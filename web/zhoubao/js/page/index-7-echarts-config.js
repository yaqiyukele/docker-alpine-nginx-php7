var option_2 = {
    color: ['#f6722a'],
    backgroundColor:'rgba(225,225,225,.3)',
    tooltip : {
        trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
    },
    grid: {
        top:'3%',
        left: '2%',
        right: '2%',
        bottom: '20%',
        containLabel: true
    },
    xAxis : [{
        type : 'category',
        data : ['爬虫系统','营销DB','标的DB', '服务平台', '前端系统','营销云和EC工具'],
        axisLine:{
            lineStyle:{
                color:'#f0f0f0'
            }
        },
        axisTick:{
            lineStyle:{
                color:"#f0f0f0"
            }
        },
        axisLabel:{
            color:"#f0f0f0",
            interval:0,
            rotate:40
        }
    }],
    yAxis : [
        {
            min:0,
            max:100,
            axisLine:{
                lineStyle:{
                    color:'#f0f0f0'
                }
            },
            axisTick:{
                lineStyle:{
                    color:"#f0f0f0"
                }
            },
            axisLabel:{
                color:"#f0f0f0",
                formatter:'{value}%'
            },
            data:{
                textStyle:{
                    color:"#f0f0f0"
                }
            },
            type : 'value'
        }
    ],
    series : [
        {
            name:'执行进度',
            type:'bar',
            barWidth: '30%',
            data:[3,2,2,3,0,0]
        }
    ]
};
var myChart_2 = echarts.init(document.getElementById('chart-2'));
myChart_2.setOption(option_2);





