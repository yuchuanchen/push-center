<html>
<head>
    <!--<title>完整demo</title>-->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>

    <style type="text/css">
        div {
            width: 100%;
        }

        .div {
            color: #F00
        }
    </style>

</head>
<body>
<div>
    <script id="editor" type="text/plain" style="width:680px;height=500px;"></script>
</div>
<div id="btns">
    <div>
        <button onclick="getContent()">获取编译器内容</button>
        <button onclick="saveEditon()">保存到数据库</button>
        <button onclick="getLastContent()">获取上一次的编辑内容</button>
    </div>
</div>
<script type="text/javascript">
    //实例化编辑器
    window.UEDITOR_HOME_URL = "/push-center/ueditor/";
    var ue = UE.getEditor("editor");
    function getContent() {
        /*var arr = [];
         arr.push("使用editor.getContent()方法可以获得编辑器的内容");
         arr.push("内容为：");
         arr.push(UE.getEditor('editor').getContent());
         alert(arr.join("\n"));*/
        document.getElementById("editcontent1").innerHTML = UE.getEditor("editor").getContent();
    }
    //保存当前编辑数据
    function saveEditon() {
        saveToDB("content=" + UE.getEditor("editor").getContent());
    }
    //保存填写的数据到数据库
    function saveToDB(str) {
        var xmlhttp;
        if (str.length == 0) {
            return;
        }
        xmlhttp = GetXmlHttpObject();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("tip").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", "saveMsgToDB.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.setRequestHeader("Content-length", str.length);
        xmlhttp.setRequestHeader("Connection", "close");
        xmlhttp.send(str);
    }
    //获取最新插入的html
    function getLastContent() {
        var xmlhttp;
        xmlhttp = GetXmlHttpObject();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("editcontent2").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "getLastContent.php?getcontent=yes", true);
        xmlhttp.send();
    }
    //获取xmlHttp实例
    function GetXmlHttpObject() {
        var xmlHttp = null;
        try {
            // Firefox, Opera 8.0+, Safari
            xmlHttp = new XMLHttpRequest();
        }
        catch (e) {
            // Internet Explorer
            try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e) {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlHttp;
    }

</script>
<div class="div">编辑器内容：</div>

<div id="editcontent1"></div>
<div class="div">保存到数据库返回信息：</div>
<div id="tip"></div>
<div class="div">上一次编辑信息：</div>
<div id="editcontent2"></div>
</body>
</html>
