<!--
使用echarts实现柱形图
-->
<!DOCTYPE html>  
<html>  
<head>  
    <meta charset="utf-8">  
    <title>test</title>  
    <script src="https://cdn.bootcss.com/echarts/3.5.4/echarts.js"></script>  
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>     
</head>  
<body>  
   <!-- 为ECharts准备一个具备大小（宽高）的Dom -->  
   <div id="container" style="width: 600px;height:400px;"></div>  
   <script>
    // 初始化两个数组，盛装从数据库中获取到的数据
    var names = [];
    //调用ajax来实现异步的加载数据
    function getusers() {
        $.ajax({
            type: "GET",//使用POST会出现多余的数据，导致无法解析
            async: false,
            url: "weekbar.php",
            data: {},
            dataType: "json",
            success: function(result){
                if(result){
                    for(var i = 0 ; i < result.length; i++){
                        var obj = {
                            value: result[i].num,
                            name: result[i].name//不要有逗号
                        };
                        names.push(obj);
                        console.info(obj);
                    }
                }
            },
            error: function(errmsg) {
                alert("Ajax获取服务器数据出错了！"+ errmsg);
            }
        });
        return names;
    }
    getusers();

    // 初始化 图表对象
    var mychart = echarts.init(document.getElementById("container"));
    // 进行相关项的设置，也就是所谓的搭搭骨架，方便待会的ajax异步的数据填充
    var option = {
        backgroundColor: '#2c343c',

        title: {
            text: 'Customized Pie',
            left: 'center',
            top: 20,
            textStyle: {
                color: '#ccc'
            }
        },
//鼠标显示模块图的比例
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },

        visualMap: {
            show: false,
            min: 80,
            max: 600,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'访问来源',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:names.sort(function (a, b) { return a.value - b.value; }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: 'rgba(255, 255, 255, 0.3)'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: 'rgba(255, 255, 255, 0.3)'
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },

                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 200;
                }
            }
        ]
    };
    // 将配置项赋给chart对象，来显示相关的数据
    mychart.setOption(option);
</script>
</body>  
</html>
