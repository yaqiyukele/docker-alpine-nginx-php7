new iSlider({
    wrap:'.containers',
    item:'.page',
    lastLocate:false,
    playClass:'play',
    onslide:function (index) {
        if(index==6){
            var values=[
                {"name":"北京","value": 27764},
                {"name":"天津","value": 1969},
                {"name":"河北","value": 1476},
                {"name":"山西","value": 474},
                {"name":"内蒙古","value": 169},
                {"name":"辽宁","value": 918},
                {"name":"吉林","value": 352},
                {"name":"黑龙江","value": 536},
                {"name":"上海","value": 4485},
                {"name":"江苏","value": 2405},
                {"name":"浙江","value": 2074},
                {"name":"安徽","value": 888},
                {"name":"福建","value": 834},
                {"name":"江西","value": 582},
                {"name":"山东","value": 2321},
                {"name":"河南","value": 1677},
                {"name":"湖北","value": 1033},
                {"name":"湖南","value": 771},
                {"name":"广东","value": 10478},
                {"name":"广西","value": 224},
                {"name":"海南","value": 91},
                {"name":"重庆","value": 637},
                {"name":"四川","value": 1329},
                {"name":"贵州","value": 146},
                {"name":"云南","value": 198},
                {"name":"西藏","value": 139},
                {"name":"陕西","value": 563},
                {"name":"甘肃","value": 246},
                {"name":"青海","value": 42},
                {"name":"宁夏","value": 105},
                {"name":"新疆","value": 94}
            ]
            var geoCoordMap={
                "北京":[116.46,39.92],
                "天津":[117.2,39.13],
                "河北":[114.48,38.03],
                "山西":[112.53,37.87],
                "内蒙古":[111.65,40.82],
                "辽宁":[123.38,41.8],
                "吉林":[125.35,43.88],
                "黑龙江":[126.63,45.75],
                "上海":[121.48,31.22],
                "江苏":[118.78,32.04],
                "浙江":[120.19,30.26],
                "安徽":[117.27,31.86],
                "福建":[119.3,26.08],
                "江西":[115.89,28.68],
                "山东":[117,36.65],
                "河南":[113.65,34.76],
                "湖北":[114.31,30.52],
                "湖南":[113,28.21],
                "广东":[113.23,23.16],
                "广西":[108.33,22.84],
                "海南":[110.35,20.02],
                "重庆":[106.54,29.59],
                "四川":[104.06,30.67],
                "贵州":[106.71,26.57],
                "云南":[102.73,25.04],
                "西藏":[91.11,29.97],
                "陕西":[108.95,34.27],
                "甘肃":[103.73,36.03],
                "青海":[101.74,36.56],
                "宁夏":[106.27,38.47],
                "新疆":[87.68,43.77]
            }
            function convertData(data){
                var res = [];
                for (var i = 0; i < data.length; i++) {
                    var geoCoord = geoCoordMap[data[i].name];
                    if (geoCoord) {
                        res.push({
                            name: data[i].name,
                            value: geoCoord.concat(data[i].value)
                        });
                    }
                }
                return res;
            }
            var option_0 = {
                backgroundColor: 'transparent',
                title: {
                    show:false
                },
                layoutCenter: ['50%', '45%'],// 如果宽高比大于 1 则宽度为 100，如果小于 1 则高度为 100，保证了不超过 100x100 的区域
                layoutSize:330,
                aspectScale:0.5,
                tooltip: {
                    trigger: 'item',
                    formatter: function (params) {
                        return params.name + ' : ' + params.value[2];
                    }
                },
                visualMap: {
                    min: 0,
                    max: 10000,
                    inRange: {
                        color: ['#50a3ba', '#eac736', '#d94e5d']
                    },
                    show:false
                },
                geo: {
                    map: 'china',
                    label: {
                        emphasis: {
                            show: false
                        }
                    },
                    itemStyle: {
                        normal: {
                            areaColor: 'transparent',
                            borderColor: '#ce2303',
                            borderWidth: 1
                        },
                        emphasis: {
                            areaColor: 'transparent'
                        }
                    }
                },
                series: [
                    {
                        name: '分布情况',
                        type: 'scatter',
                        coordinateSystem: 'geo',
                        data: convertData(values),
                        symbolSize: 12,
                        label: {
                            normal: {
                                show: false
                            },
                            emphasis: {
                                show: false
                            }
                        },
                        itemStyle: {
                            emphasis: {
                                borderColor: '#ce2303',
                                borderWidth: 4
                            }
                        }
                    }
                ]
            };
            var myChart_0=new echarts.init(document.getElementById("chart-0"));
            myChart_0.setOption(option_0);
        }
        if(index==7){
            /*整体阶段进展*/
            var option_total = {
                color: ['#ce2303'],
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
                            color:'#ce2303'
                        }
                    },
                    axisTick:{
                        lineStyle:{
                            color:"#ce2303"
                        }
                    },
                    axisLabel:{
                        color:"#ce2303",
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
                                color:'#ce2303'
                            }
                        },
                        axisTick:{
                            lineStyle:{
                                color:"#ce2303"
                            }
                        },
                        axisLabel:{
                            color:"#ce2303",
                            formatter:'{value}%'
                        },
                        splitLine:{
                            lineStyle:{
                                color:"#ce2303"
                            }
                        },
                        data:{
                            textStyle:{
                                color:"#ce2303"
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
                        data:[49,42,10,50,30,0]
                    }
                ]
            };
            var myChart_total = echarts.init(document.getElementById('chart-total'));
            myChart_total.setOption(option_total);
        }
    }
});
