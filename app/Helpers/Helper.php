<?php
namespace App\Helpers;
use App\Models\Subscription;
use Auth;
use DB;

use Storage;

class Helper
{

    public static function formatCallLogTimestamp($timestamp)
    {
        $dateTime = new DateTime($timestamp);
        $today = new DateTime('today');
        $yesterday = new DateTime('yesterday');
        if ($dateTime->format('Y-m-d') === $today->format('Y-m-d')) {
            return 'Today ' . $dateTime->format('h:i A');
        } elseif ($dateTime->format('Y-m-d') === $yesterday->format('Y-m-d')) {
            return 'Yesterday ' . $dateTime->format('h:i A');
        } elseif ($dateTime->format('W') === $today->format('W')) {
            return $dateTime->format('l h:i A');
        } else {
            return $dateTime->format('Y-m-d h:i A');
        }
    }
    static function deactivateCollectionHtml($intID, $parameter, $checked)
    {
        return '<div class="text-center"><div class="form-check form-switch form-switch-right form-switch-lg form-switch-success">
                    <input name="status" class="form-check-input" type="checkbox" id="custom-toggle-button" data-id="' . base64_encode(base64_encode($intID)) . '"  onchange="return deactivateCollection(\'' . base64_encode(base64_encode($intID)) . '\',\'' . $parameter . '\')" ' . $checked . '>
                </div></div>';
    }

    static function activateCollectionHtml($intID, $parameter, $checked)
    {
        return '<div class="text-center"><div class="form-check form-switch form-switch-lg form-switch-right form-switch-success">
                    <input name="status" class="form-check-input" type="checkbox" id="custom-toggle-button" data-id="' . base64_encode(base64_encode($intID)) . '"  onchange="return activateCollection(\'' . base64_encode(base64_encode($intID)) . '\',\'' . $parameter . '\')" ' . $checked . '>
                </div></div>';

    }
    static function approvalCollectionHtml($intID, $parameter, $checked)
    {
        return '<div class="text-center"><div class="form-check form-switch form-switch-lg form-switch-right form-switch-success">
                    <input name="status" class="form-check-input" type="checkbox" id="custom-toggle-button" data-id="' . base64_encode(base64_encode($intID)) . '"  onchange="return approvalCollection(\'' . base64_encode(base64_encode($intID)) . '\',\'' . $parameter . '\')" ' . $checked . '>
                </div></div>';

    }

    public static function humanFileSize($size, $unit = "")
    {
        if ((!$unit && $size >= 1 << 30) || $unit == "GB") {
            return number_format($size / (1 << 30), 2) . " GB";
        }
        if ((!$unit && $size >= 1 << 20) || $unit == "MB") {
            return number_format($size / (1 << 20), 2) . " MB";
        }
        if ((!$unit && $size >= 1 << 10) || $unit == "KB") {
            return number_format($size / (1 << 10), 2) . " KB";
        }
        return number_format($size) . " bytes";
    }

    public static function getLogiUserData()
    {
        $user = auth()->user();
        return $user->getRoleNames()->first();
    }

    public static function activate($model, $encID)
    {
        $response = ['status' => 'error', 'msg' => 'Failed to activate record.'];
        $intId = base64_decode(base64_decode($encID));
        $record = $model::find($intId);
        if ($record) {
            $record->status = 'active';
            if ($record->save()) {
                $response['status'] = 'success';
                $response['msg'] = 'Record activated successfully.';
            }
        }
        return $response;
    }
    public static function deactivate($model, $encID)
    {
        $response = ['status' => 'error', 'msg' => 'Failed to deactivate record.'];
        $intId = base64_decode(base64_decode($encID));
        $record = $model::find($intId);
        if ($record) {
            $record->status = 'inactive';
            if ($record->save()) {
                $response['status'] = 'success';
                $response['msg'] = 'Record deactivated successfully.';
            }
        }
        return $response;
    }
    public static function storeRecord($controller, $model, $request, $routeName)
    {
        $response = ['status' => 'error', 'msg' => 'Failed to save data, something went wrong on the server.'];
        DB::beginTransaction();
        try {
            $modelInstance = new $model;
            $modelInstance = $controller->_storeOrUpdate($modelInstance, $request);
            if ($modelInstance) {
                DB::commit();
                $response['status'] = 'success';
                $response['url'] = route($routeName);
                $response['msg'] = 'Data has been saved successfully.';
            } else {
                DB::rollback();
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['error_msg'] = $e->getMessage();
        }
        return $response;
    }
    public static function actionButtons($id, $editRoute, $deleteRoute)
    {
        $encodedId = base64_encode(base64_encode($id));

        $btnEdit = '<a href="' . route($editRoute, [$encodedId]) . '" class="btn btn-icon btn-light btn-sm" title="' . __('Edit') . '">
            <i class="mdi mdi-clipboard-edit-outline text-primary mdi-24px"></i>
        </a>';

        $btnDelete = '<a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="' . route($deleteRoute, [$encodedId]) . '" class="delete-user action-icon btn btn-icon btn-light btn-sm" title="' . __('Delete') . '">
            <i class="mdi mdi-delete-alert-outline mdi-24px text-danger"></i>
        </a>';

        return '<div class="text-center">' . $btnEdit . ' ' . $btnDelete . '</div>';
    }
    public static function updateRecord($controller, $model, $request, $routeName, $encodedId)
    {
        $response = ['status' => 'error', 'msg' => 'Failed to update data, something went wrong on the server.'];

        DB::beginTransaction();
        try {
            $id = base64_decode(base64_decode($encodedId));
            $modelInstance = $model::find($id);
            if ($modelInstance) {
                $modelInstance = $controller->_storeOrUpdate($modelInstance, $request);
                if ($modelInstance) {
                    DB::commit();
                    $response['status'] = 'success';
                    $response['url'] = route($routeName);
                    $response['msg'] = 'Data has been updated successfully.';
                } else {
                    DB::rollback();
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['error_msg'] = $e->getMessage();
        }

        return $response;
    }
    public static function destroyRecord($model, $encID)
    {
        $response = [
            'status' => 'error',
            'msg' => 'Failed to delete record.'
        ];
        $intId = base64_decode(base64_decode($encID));
        $record = $model::find($intId);
        if ($record) {
            if ($model::where('id', $intId)->delete()) {
                $response['status'] = 'success';
                $response['msg'] = 'Data deleted successfully!';
            }
        }
        return $response;
    }
    public static function getPeriod()
    {
        $yearMonth = session('yearMonth');
        if ($yearMonth && strlen($yearMonth) === 6) {
            $yearMonth = substr($yearMonth, 0, 4) . substr($yearMonth, 4, 2);
        } else {
            $yearMonth = date('Ym');
        }
        return $yearMonth;
    }
    public static function getPeriodInFormat()
    {
        $yearMonth = session('yearMonth');
        if ($yearMonth && strlen($yearMonth) === 6) {
            $yearMonth = substr($yearMonth, 0, 4) . '/' . substr($yearMonth, 4, 2);
        } else {
            $yearMonth = date('m/Y');
        }
        return $yearMonth;
    }
    public static function convertNumberToWords($number)
    {
        $hyphen = ' ';
        $conjunction = ' and ';
        $separator = ' ';
        $negative = 'negative ';
        $decimal = ' cents ';
        $dictionary = [
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion'
        ];

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . self::convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos((string) $number, '.') !== false) {
            list($number, $fraction) = explode('.', (string) $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = (int) ($number / 100);
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . self::convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = self::convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::convertNumberToWords($remainder);
                }
                break;
        }

        if ($fraction !== null && is_numeric($fraction)) {
            $fraction = substr(str_pad($fraction, 2, '0'), 0, 2);
            $string .= $conjunction . $fraction . $decimal;
        }

        return ucfirst($string);
    }




    public static function decodeUserId($encodedId)
    {
        if (empty($encodedId)) {
            return null;
        }

        $decoded = base64_decode(base64_decode($encodedId), true);
        return ($decoded !== false && is_numeric($decoded)) ? (int) $decoded : null;
    }



    public static function hasActiveSubscription()
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        return Subscription::where([
            'user_id'=>$user->id,
            'subscription_status' => 'active'
            ])->exists();
    }

}
?>