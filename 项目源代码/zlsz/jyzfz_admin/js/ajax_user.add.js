var vf = $(".demoform").Validform({
	tiptype: 2,
	datatype: {
		"zh2-4": /^[\w\W]{2,10}$/,

	}
});

vf.addRule(
	[{
			ele: "[name=username]",
			"datatype": "*6-16",
			nullmsg: "用户名不能为空！",
			sucmsg: "符合标准！",
			errormsg: "用户名格式不标准",
			ajaxurl: "user.check.php",
			altercss: "hui"
		}, {
			ele: "[name=pwd]",
			datatype: "password",
			nullmsg: "密码不能为空！",
			sucmsg: "符合标准！",
			errormsg: "密码为6-18位英文字母和数字！"
		}, {
			ele: "[name=repwd]",
			datatype: "*6-18",

			recheck: "pwd",
			sucmsg: "符合标准！",
		}, {
			"ele": "[name=job]",
			"datatype": "*",
			sucmsg: "符合标准！",
			nullmsg: "请选择性别"
		},  {
			ele: "[name=name]",
			datatype: "zh2-6",
			sucmsg: "符合标准！",
			ajaxurl: "user.nickname.check.php",
			errormsg: "请填写2-10任意字符的昵称！",
		}, {
			"ele": "[name=isadd]",
			"datatype": "*",
			nullmsg: "请选择是否注册地址"
		},  {
			"ele": "[name=point]",
			"datatype": "n1-11",
			errormsg: "绿化值为1-10位数字"
		},

	]
);
