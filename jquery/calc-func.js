
document.write("<style>\
.butt{width: 50px; font-family: Times New Roman; font-weight: bold; font-size: 15px;}\
.equal{width: 100px; font-family: Times New Roman; font-weight: bold; font-size: 15px;}\
.disp{text-align: right; font-family: Times New Roman; font-weight: bold; font-size: 15px;}\
</style>");

var oper="";
var out="";
var lsd="";
var resa=false;

function isNum(argvalue)
{
	argvalue=argvalue.toString();

	if (argvalue.length==0)
		return false;

	for(var n=0; n<argvalue.length; n++)
		if(argvalue.substring(n, n+1) < "0" || argvalue.substring(n, n+1) > "9")
			return false;
	
	return true;
}

function factorialFunction(n)
{
	if(isNaN(n) || n<0)
		return 'E-';

	value=n==0?1:n*factorialFunction(n - 1);
	if(String(value).indexOf('.')!=-1 || value==Number.POSITIVE_INFINITY)
		return 'E-';

	return value;
}

function simpleCalc(ss,df)
{
	var result = "";
	var ss = df.length;
	var arg1 ="";
	var arg2 = "";
	var bol = true;
	
	for(var c=0; c<ss; c++)
	{
		var digit=df.charAt(c);
		
		if(isNum(digit))
		{
			if(bol==true)
				arg1=arg1+digit.toString();
			
			if(bol==false)
				arg2=arg2+digit;
		}
		else
		{
			if(c==0 && digit=="-")
				arg1=arg1+digit.toString();

			else if(digit==".")
			{
				if(bol==true)
					arg1=arg1+digit.toString();
				else
					arg2=arg2+digit.toString();
			}
			else
			{
				bol=false;
				oper=digit;
			}
		}
	}

	if(oper=="" || oper==null)
	{
		out=arg1;
		return arg1;
	}
	else if(arg2=="" || arg2==null)
	{
		out=arg1;
		return arg1;
	}

	if(oper=="-")
	{
		var res=Math.round((parseFloat(arg1)-parseFloat(arg2))*10000)/10000;
		result=res;
		out=arg1+"-"+arg2+"="+res;
	}
	if(oper=="+")
	{
		var res=Math.round((parseFloat(arg1)+parseFloat(arg2))*10000)/10000;
		result=res;
		out=arg1+"+"+arg2+"="+res;
	}
	if(oper=="/")
	{
		var res=Math.round((parseFloat(arg1)/parseFloat(arg2))*10000)/10000;
		result=res;
		out=arg1+"/"+arg2+"="+res;
	}
	if(oper=="*")
	{
		var res=Math.round((parseFloat(arg1)*parseFloat(arg2))*10000)/10000;
		result=res;
		out=arg1+"*"+arg2+"="+res;
	}
	return result;
}

function change(name)
{
	var sd=name.value;
	var df=document.calci.result.value;

	if(sd=="AC")
	{
		document.calci.result.value="";
		df="";
		out="clear data";
	}
	else if(sd=="<")
	{
		if(df.length>=1)
		{
		var res2=df.substring(0,df.length-1);
		document.calci.result.value=res2;
	 	}
	}
	else if(sd=="x!")
	{
		var res=simpleCalc("=",df)
	  	var res2=factorialFunction(res);
	    	out="("+out+")!="+res2;
	  	document.calci.result.value=res2;
		resa=true;
	}
	else if(sd=="=")
	{
		var res=simpleCalc(sd,df)
		document.calci.result.value=res;
		resa=true;
	}
	else if(sd!="")
	{
		if(df=="" || df==null)
   			document.calci.result.value=sd;

		else
		{
			var cal=false;
			if(isNaN(sd) && sd!=".")
			{
				for(var si=0; si<df.length; si++)
				{
					var d=df.charAt(si);
					if(isNaN(d))
					{
					 	if(si==0 && d=="-"){}
					 	else
							cal=true;
					}
				}
			}

			if(cal==true)
			{
				var res=simpleCalc("=",df)
				document.calci.result.value=res+sd;
				resa=false;
			}
			else
			{
				if(resa==true && !isNaN(sd))
					df="";

				resa = false;
				document.calci.result.value=df+sd;
			}
		}
	}
	lsd=sd;
}


