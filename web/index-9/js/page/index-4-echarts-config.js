var option_1 = {
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
        bottom: '12%',
        containLabel: true
    },
    xAxis : [{
        type : 'category',
        data : ['2017/9/25','2017/9/26','2017/9/27', '2017/9/28', '2017/9/29'],
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
                formatter:'{value}'
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
            name:'爬取数据量',
            type:'bar',
            barWidth: '30%',
            data:[6313,12206,7851,1879,6444]
        }
    ]
};
var myChart_1 = echarts.init(document.getElementById('chart-1'));
myChart_1.setOption(option_1);

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
        bottom: '12%',
        containLabel: true
    },
    xAxis : [{
        type : 'category',
        data : ['EC营销调研','资源规划','爬虫系统', '数据平台', '前端展现'],
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
            data:[100,100,95,90,90]
        }
    ]
};
var myChart_2 = echarts.init(document.getElementById('chart-2'));
myChart_2.setOption(option_2);


