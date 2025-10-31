const mrrColors = ['#22C55E', '#3B82F6', '#F59E0B', '#EF4444']; // new, expansion, contraction, churn
const optionsMrr = {
  chart:{ type:'bar', height:360, stacked:true, toolbar:{show:false}},
  series:[
    { name:'New MRR', data:[1200,1400,900,1600,1200,1800] },
    { name:'Expansion MRR', data:[500,300,700,200,600,400] },
    { name:'Contraction MRR', data:[-200,-150,-300,-250,-100,-200] },
    { name:'Churned MRR', data:[-300,-400,-250,-350,-450,-300] }
  ],
  colors:mrrColors,
  xaxis:{ categories:['2025-04','2025-05','2025-06','2025-07','2025-08','2025-09'] },
  yaxis:{ labels:{ formatter:v=>'RM '+v.toLocaleString() } },
  dataLabels:{ enabled:false },
  stroke:{ width:1, colors:['#fff'] },
  tooltip:{ y:{ formatter:v=>'RM '+v.toLocaleString() } },
  grid:{ borderColor:'#eee' },
  annotations:{
    yaxis:[],
    xaxis:[]
  }
};
const chartMrr = new ApexCharts(document.querySelector('#mrr_waterfall'), optionsMrr);
chartMrr.render().then(()=>{
  // Add total MRR line as a separate chart overlay (simpler: compute totals and add as extra line series)
  const totals = optionsMrr.series[0].data.map((_,i)=>
    optionsMrr.series.reduce((sum,s)=> sum + (s.data[i]||0), 0)
  );
  chartMrr.appendSeries({ name:'Total MRR', type:'line', data:totals, color:'#111827' });
});




new ApexCharts(document.querySelector('#arr_line'), {
  chart:{ type:'line', height:300, toolbar:{show:false}},
  series:[{ name:'ARR', data:[120000,124000,130000,137000,141000,149000]}],
  xaxis:{ categories:['2025-04','2025-05','2025-06','2025-07','2025-08','2025-09'] },
  stroke:{ width:3, curve:'smooth' },
  colors:['#111827'],
  yaxis:{ labels:{ formatter:v=>'RM '+v.toLocaleString() } },
  tooltip:{ y:{ formatter:v=>'RM '+v.toLocaleString() } }
}).render();


new ApexCharts(document.querySelector('#tenants_status'), {
  chart:{ type:'bar', height:320, stacked:true, toolbar:{show:false}},
  series:[
    {name:'Active', data:[80,85,89,92,96,100]},
    {name:'Trialing', data:[12,15,14,16,18,17]},
    {name:'Past-due', data:[3,2,4,3,4,5]},
    {name:'Suspended', data:[1,1,1,2,2,2]},
    {name:'Canceled', data:[2,1,2,1,2,1]}
  ],
  colors:['#22C55E','#3B82F6','#F59E0B','#6B7280','#EF4444'],
  xaxis:{ categories:['Apr','May','Jun','Jul','Aug','Sep'] },
  dataLabels:{ enabled:false },
  yaxis:{ title:{ text:'Tenants' } },
  legend:{ position:'top' }
}).render();


new ApexCharts(document.querySelector('#churn_lines'), {
  chart:{ type:'line', height:320, toolbar:{show:false}},
  series:[
    { name:'Logo Churn %', data:[1.2,1.0,1.6,1.1,1.4,1.3] },
    { name:'Revenue Churn %', data:[1.6,1.3,2.0,1.5,1.9,1.7] }
  ],
  colors:['#EF4444','#F59E0B'],
  stroke:{ width:3, curve:'smooth' },
  xaxis:{ categories:['Apr','May','Jun','Jul','Aug','Sep'] },
  yaxis:{ labels:{ formatter:v=>v.toFixed(1)+'%' } },
  tooltip:{ y:{ formatter:v=>v.toFixed(2)+'%' } },
  markers:{ size:3 }
}).render();

new ApexCharts(document.querySelector('#plan_mix'), {
  chart:{ type:'area', height:320, stacked:true, toolbar:{show:false}},
  series:[
    { name:'Plan A', data:[8000,8500,8800,9000,9400,9800] },
    { name:'Pro', data:[12000,12500,13100,13800,14400,15200] },
    { name:'Platinum', data:[6000,6400,6800,7300,7800,8200] }
  ],
  colors:['#A78BFA','#3B82F6','#22C55E'],
  xaxis:{ categories:['Apr','May','Jun','Jul','Aug','Sep'] },
  dataLabels:{ enabled:false },
  stroke:{ curve:'smooth', width:2 },
  yaxis:{ labels:{ formatter:v=>'RM '+v.toLocaleString() } },
  fill:{ opacity:0.55 }
}).render();

const tenants = ['VC Majumas','PalmOne','GreenOil','NovaPlant','EastPalm'];
const metrics = ['HQ Seats','Branch Seats','Branches','Suppliers','Tickets/mo'];
const seriesHeat = tenants.map(t => ({
  name: t,
  data: metrics.map(m => Math.floor(40 + Math.random()*70)) // utilization %
}));
new ApexCharts(document.querySelector('#upgrade_heatmap'), {
  chart:{ type:'heatmap', height:380, toolbar:{show:false}},
  dataLabels:{ enabled:true, formatter:(v)=>v+'%' },
  plotOptions:{ heatmap:{ colorScale:{ ranges:[
    { from:0, to:60, color:'#E5E7EB' },
    { from:61, to:80, color:'#F59E0B' },
    { from:81, to:100, color:'#EF4444' }
  ]}}},
  series: seriesHeat.map((s,i)=>({ name:s.name, data: s.data.map((v,j)=>({x:metrics[j], y:v})) })),
  xaxis:{ type:'category' },
  colors:['#22C55E'] // ignored due to colorScale
}).render();


// new ApexCharts(document.querySelector('#hq_tickets_by_day'), {
//   chart:{ type:'bar', height:300, toolbar:{show:false}},
//   series:[{ name:'MT', data:[3.2, 5.8, 4.1, 0, 6.7, 7.4, 2.9] }], // per day
//   xaxis:{ categories:['01','02','03','04','05','06','07'] },
//   yaxis:{ labels:{ formatter:v=>v.toFixed(2) } },
//   colors:['#3B82F6'],
//   dataLabels:{ enabled:false },
//   grid:{ borderColor:'#eee' },
//   tooltip:{ y:{ formatter:v=>v.toFixed(3)+' MT' } }
// }).render();



// const suppliers = ['Aplas','VC','WJ','SM','SP','Raymond','Sahabat TK','HJ Dev','LCH','Prolific'];
// const mt = [164.28, 142.10, 138.55, 121.90, 118.30, 110.40, 104.25, 98.60, 95.10, 90.00];
// new ApexCharts(document.querySelector('#hq_top_suppliers'), {
//   chart:{ type:'bar', height:380, toolbar:{show:false}},
//   plotOptions:{ bar:{ horizontal:true, barHeight:'60%' } },
//   series:[{ name:'MT', data: mt }],
//   xaxis:{ categories: suppliers, labels:{ formatter:v=>v.toFixed(2) } },
//   colors:['#22C55E'],
//   dataLabels:{ enabled:true, formatter:v=>v.toFixed(2)+' MT' }
// }).render();

// new ApexCharts(document.querySelector('#hq_mill_mix'), {
//   chart:{ type:'donut', height:300 },
//   series:[1240.5, 320.3, 210.1, 88.6], // MT by mill
//   labels:['LCH','Mill 2','Mill 3','Mill 4'],
//   colors:['#3B82F6','#A78BFA','#22C55E','#F59E0B'],
//   dataLabels:{ enabled:true, formatter:(v,opts)=>opts.w.config.series[opts.seriesIndex].toFixed(0)+' MT' },
//   legend:{ position:'bottom' }
// }).render();

// new ApexCharts(document.querySelector('#hq_credit_cash'), {
//   chart:{ type:'bar', height:300, toolbar:{show:false}},
//   series:[
//     { name:'Credit (Invoices)', data:[92000, 101500, 98400, 110200, 103600, 115300] },
//     { name:'Cash Purchases', data:[38000, 41000, 39000, 36000, 42000, 39500] }
//   ],
//   colors:['#111827','#10B981'],
//   xaxis:{ categories:['Apr','May','Jun','Jul','Aug','Sep'] },
//   yaxis:{ labels:{ formatter:v=>'RM '+v.toLocaleString() } },
//   dataLabels:{ enabled:false },
//   tooltip:{ y:{ formatter:v=>'RM '+v.toLocaleString() } },
//   legend:{ position:'top' }
// }).render();

// new ApexCharts(document.querySelector('#hq_deductions'), {
//   chart:{ type:'bar', height:280, toolbar:{show:false}},
//   series:[{ name:'Amount', data:[3250, 1880, 940] }],
//   xaxis:{ categories:['Advance','Transport','Other'] },
//   colors:['#EF4444'],
//   dataLabels:{ enabled:true, formatter:v=>'RM '+v.toLocaleString() }
// }).render();


// new ApexCharts(document.querySelector('#hq_price_per_mt'), {
//   chart:{ type:'line', height:300, toolbar:{show:false}},
//   series:[{ name:'RM per MT', data:[834, 820, 845, 860, 855, 872] }],
//   xaxis:{ categories:['Apr','May','Jun','Jul','Aug','Sep'] },
//   colors:['#2563EB'],
//   stroke:{ width:3, curve:'smooth' },
//   dataLabels:{ enabled:false },
//   tooltip:{ y:{ formatter:v=>'RM '+v.toFixed(2)+'/MT' } }
// }).render();


// new ApexCharts(document.querySelector('#br_tickets_14d'), {
//   chart:{ type:'bar', height:300, toolbar:{show:false}},
//   series:[{ name:'Tickets', data:[12,9,15,18,11,0,0,14,16,10,13,17,9,8] }],
//   xaxis:{ categories:['Aug 16','17','18','19','20','21','22','23','24','25','26','27','28','29'] },
//   colors:['#3B82F6'],
//   dataLabels:{ enabled:false },
//   grid:{ borderColor:'#eee' }
// }).render();

// new ApexCharts(document.querySelector('#br_supplier_top10'), {
//   chart:{ type:'bar', height:340, toolbar:{show:false}},
//   plotOptions:{ bar:{ columnWidth:'45%' }},
//   series:[{ name:'MT', data:[42.6,38.1,33.3,29.8,27.4,24.9,22.0,20.7,18.4,16.3] }],
//   xaxis:{ categories:['VC','Aplas','WJ','SM','SP','Raymond','Sahabat','Maju','HKSE','Koh'], labels:{ rotate:-25 }},
//   colors:['#6366F1'],
//   dataLabels:{ enabled:false },
//   tooltip:{ y:{ formatter:v=>v.toFixed(2)+' MT' } }
// }).render();

// new ApexCharts(document.querySelector('#br_cash_daily'), {
//   chart:{ type:'area', height:300, toolbar:{show:false}},
//   series:[{ name:'Cash Paid (RM)', data:[0,1200,0,3500,2200,0,0,4100,1800,0,2600,0,0,3200,1500] }],
//   xaxis:{ categories:['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'] },
//   colors:['#22C55E'],
//   stroke:{ width:2, curve:'smooth' },
//   fill:{ opacity:0.35 },
//   tooltip:{ y:{ formatter:v=>'RM '+v.toLocaleString() } }
// }).render();

// new ApexCharts(document.querySelector('#br_deductions_donut'), {
//   chart:{ type:'donut', height:300 },
//   series:[2450, 1380, 720],
//   labels:['Advance','Transport','Other'],
//   colors:['#F59E0B','#3B82F6','#EF4444'],
//   dataLabels:{ enabled:true },
//   tooltip:{ y:{ formatter:v=>'RM '+v.toLocaleString() } },
//   legend:{ position:'bottom' }
// }).render();


new ApexCharts(document.querySelector('#br_today_activity'), {
  chart:{ height:300, type:'line', toolbar:{show:false}},
  series:[
    { name:'Tickets', type:'column', data:[0,1,2,3,4,3,5,6,4,2] },
    { name:'Cash Bills', type:'line', data:[0,0,1,1,1,1,2,2,1,0] }
  ],
  xaxis:{ categories:['8am','9','10','11','12','1pm','2','3','4','5'] },
  colors:['#6B7280','#EF4444'],
  dataLabels:{ enabled:false },
  stroke:{ width:[0,3], curve:'smooth' },
  yaxis:[{ title:{text:'Count'} }],
  legend:{ position:'top' }
}).render();


new ApexCharts(document.querySelector('#br_avg_mt_ticket'), {
  chart:{ type:'bar', height:300, toolbar:{show:false}},
  series:[{ name:'Avg MT/Ticket', data:[3.21,3.05,2.88,2.66,2.59] }],
  xaxis:{ categories:['VC','Aplas','WJ','SM','SP'] },
  colors:['#0EA5E9'],
  dataLabels:{ enabled:true, formatter:v=>v.toFixed(2) }
}).render();

