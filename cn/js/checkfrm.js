function checkForm(){
  if($("#textfield1").val() == ""){
    alert("姓名不能为空！");
    $("#textfield1").focus();
    return false;
  }
  if($("#textfield2").val() == ""){
    alert("姓别不能为空！");
    $("#textfield2").focus();
    return false;
  }
  if($("#textfield3").val() == ""){
    alert("出生年月不能为空！");
    $("#textfield3").focus();
    return false;
  }
  if($("#textfield5").val() == ""){
    alert("申请者现状不能为空！");
    $("#textfield5").focus();
    return false;
  }
  if($("#textfield6").val() == ""){
    alert("出生地不能为空！");
    $("#textfield6").focus();
    return false;
  }
  if($("#textfield7").val() == ""){
    alert("出生地不能为空！");
    $("#textfield7").focus();
    return false;
  }
  if($("#textfield8").val() == ""){
    alert("户口所在地不能为空！");
    $("#textfield8").focus();
    return false;
  }
  if($("#textfield9").val() == ""){
    alert("户口所在地不能为空！");
    $("#textfield9").focus();
    return false;
  }
  if($("#textfield10").val() == ""){
    alert("现住地址不能为空！");
    $("#textfield10").focus();
    return false;
  }
  if($("#textfield11").val() == ""){
    alert("父亲姓名不能为空！");
    $("#textfield11").focus();
    return false;
  }
  if($("#textfield12").val() == ""){
    alert("父亲年龄不能为空！");
    $("#textfield12").focus();
    return false;
  }
  if($("#textfield13").val() == ""){
    alert("母亲姓名不能为空！");
    $("#textfield11").focus();
    return false;
  }
  if($("#textfield14").val() == ""){
    alert("母亲年龄不能为空！");
    $("#textfield13").focus();
    return false;
  }
  if($("#textfield15").val() == ""){
    alert("请填写经费支付者姓名！");
    $("#textfield14").focus();
    return false;
  }
  if($("#textfield16").val() == ""){
    alert("请填写与申请者关系！");
    $("#textfield15").focus();
    return false;
  }
  if($("#textfield17").val() == ""){
    alert("请填写经费支付者工作单位！");
    $("#textfield16").focus();
    return false;
  }
  if($("#textfield19").val() == ""){
    alert("请填写手机号！");
    $("#textfield19").focus();
    return false;
  }
  if($("#textfield21").val() == ""){
    alert("请填写qq号！");
    $("#textfield21").focus();
    return false;
  }
  if($("#textfield22").val() == ""){
    alert("请填写是否来过日本！");
    $("#textfield22").focus();
    return false;
  }
  if($("#textfield24").val() == ""){
    alert("请填写是否参加过日语级别考试！");
    $("#textfield24").focus();
    return false;
  }
  if($("#textfield29").val() == ""){
    alert("请填写是否学习过日语！");
    $("#textfield29").focus();
    return false;
  }
  if($("#textfield32").val() == ""){
    alert("请填写高中学校名称！");
    $("#textfield32").focus();
    return false;
  }
  if($("#textfield33").val() == ""){
    alert("请填写高中学习类型！");
    $("#textfield33").focus();
    return false;
  }
  if($("#textfield35").val() == ""){
    alert("请填写高中毕业时间！");
    $("#textfield35").focus();
    return false;
  }
  if($("#textfield41").val() == ""){
    alert("请填写意向院校！");
    $("#textfield41").focus();
    return false;
  }
  if($("#textfield42").val() == ""){
    alert("请填写入学时间！");
    $("#textfield42").focus();
    return false;
  }
  return true;
}