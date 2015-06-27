function Csw(id,c,w){if($(id)){ $(id).addClass($(id).hasClass(c)?w:($(id).hasClass(w)?c:c)); }}
function Css(id,c){if($(id)){$(id).setProperty('class',c)}};
function Err(e,t,f){$(e).innerHTML=t;}
function Emp(o){return (o==null||o.length==0||!/\w+/.test(Rtm(Ltm(o))));}
function Phn(o){return (!Emp(o)&&/^\d{3}-\d{3}-\d{4}$/.test(o) );}
function Ema(o){return (!Emp(o)&&/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(o));}
function Ltm(str){
 var w=new String(" \t\n\r");
 var s=new String(str);
 if (w.indexOf(s.charAt(0))!=-1) {
  var j=0,i=s.length;
  while (j<i&&w.indexOf(s.charAt(j))!=-1)j++;
  s=s.substring(j,i);
 }
 return s;
}
function Rtm(str){
 var w=new String(" \t\n\r");
 var s=new String(str);
 if (w.indexOf(s.charAt(s.length-1)) != -1){
  var i=s.length-1;
  while (i>=0&&w.indexOf(s.charAt(i))!=-1)i--;
   s=s.substring(0,i+1);
 }
 return s;
}