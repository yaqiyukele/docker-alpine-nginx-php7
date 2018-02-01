new iSlider({
    wrap:'.containers',
    item:'.page',
    lastLocate:false,
    playClass:'play',
    onslide:function (index) {
        if(index==6){
            /*整体阶段进展*/
            var option_total = {
                color: ['#ffffff'],
                backgroundColor:'transparent',
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    top:'2%',
                    left: '2%',
                    right: '3%',
                    bottom: '20%',
                    containLabel: true
                },
                xAxis : [{
                    type : 'category',
                    data : ['爬虫系统','营销DB','标的DB', '服务平台', '前端系统','营销云和EC工具'],
                    axisLine:{
                        lineStyle:{
                            color:'#ffffff'
                        }
                    },
                    axisTick:{
                        lineStyle:{
                            color:"#ffffff"
                        }
                    },
                    axisLabel:{
                        color:"#ffffff",
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
                                color:'#ffffff'
                            }
                        },
                        axisTick:{
                            lineStyle:{
                                color:"#ffffff"
                            }
                        },
                        axisLabel:{
                            color:"#ffffff",
                            formatter:'{value}%'
                        },
                        splitLine:{
                            lineStyle:{
                                color:"#ffffff"
                            }
                        },
                        data:{
                            textStyle:{
                                color:"#ffffff"
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
                        data:[30,20,10,30,12,0]
                    }
                ]
            };
            var myChart_total = echarts.init(document.getElementById('chart-total'));
            myChart_total.setOption(option_total);
        }
    }
});
