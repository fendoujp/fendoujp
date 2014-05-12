<!--内容开始-->
<div class="center container slide-box">
  <?php if($first_info['s_img']!=""){?>
  <div class="banner"><img src="<?php echo $first_info['s_img'];?>" width="958" height="auto" /></div>
  <div class="banner-bj"></div>
  <?php }?>
  <?php include(TPL_PATH."side.php");?>
  <div class="listcenter-right">
    <?php $crumb = crumb($class_id);?>
    <div class="location"><span>当前位置：<?php foreach($crumb as $v){if($v['id']==$class_id){echo $v['name']; }else{?><a href="<?php echo $v['url'];?>"><?php echo $v['name'];?></a> &gt; <?php }}?></span>
      <h2><?php echo $class_data['s_name'];?></h2>
    </div>
    <div class="list-cen">
      <div class="sign">
        <h2>奋斗在日本留学网<br />
          调查评估表</h2>
        <div class="add">
         <p class="fl">官方网址：www.fendoujp.com</p> <p class="fr">会社电话：03-5822-5520（东京）</p>
         </div>
        <form id="signup" action="/index.php" method="post" onsubmit="return checkForm()">
        <input type="hidden" name="a" value="article" />
        <input type="hidden" name="t" value="signup_save" />
        <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="sign-center">
          <tr>
            <td colspan="2"><table width="100%" border="0">
                <tr align="left">
                  <td scope="col">申请姓名：
                    <input type="text" name="data[name]" id="textfield1" style="width:135px;"/>
                  </td>
                  <td scope="col">性 別：
                    <input type="text" name="data[sex]" id="textfield2" style="width:140px;"/>
                  </td>
                  <td scope="col">出生年月：
                    <input type="text" name="data[birthday]" id="textfield3" style="width:140px;"/></td>
                </tr>
                <tr align="left">
                  <td scope="col">护 照 号：
                    <input type="text" name="data[passport]" id="textfield4" style="width:140px;"/></td>
                  <td scope="col">申请者现状：
                    <input type="text" name="data[actuality]" id="textfield5" style="width:140px;"/></td>
                  <td scope="col">（工作/在校）</td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>出生地：
              <input type="text" name="data[addr_province]" id="textfield6" style="width:90px;"/>
              省
              <input type="text" name="data[addr_city]" id="textfield7" style="width:90px;"/>
              市</td>
            <td>户口所在地：
              <input type="text" name="data[addr_province1]" id="textfield8" style="width:90px;"/>
              省
              <input type="text" name="data[addr_city1]" id="textfield9" style="width:90px;"/>
              市</td>
          </tr>
          <tr>
            <td colspan="2">现住地址：
              <input type="text" name="data[address]" id="textfield10" style="width:87%;"/></td>
          </tr>
          <tr>
            <td>父亲姓名：
              <input type="text" name="data[father]" id="textfield11" /></td>
            <td>年龄：
              <input type="text" name="data[father_age]" id="textfield12" /></td>
          </tr>
          <tr>
            <td>母亲姓名：
              <input type="text" name="data[mother]" id="textfield13" /></td>
            <td>年龄：
              <input type="text" name="data[mother_age]" id="textfield14" /></td>
          </tr>
          <tr>
            <td>经费支付者姓名：
              <input type="text" name="data[pay_name]" id="textfield15" /></td>
            <td>与申请者关系：
              <input type="text" name="data[relation]" id="textfield16" /></td>
          </tr>
          <tr>
            <td colspan="2">经费支付者工作单位：
              <input type="text" name="data[pay_work]" id="textfield17" style="width:78%;"/></td>
          </tr>
          <tr>
            <td>固定电话：
              <input type="text" name="data[phone]" id="textfield18" style="width:217px;"/></td>
            <td>手机：
              <input type="text" name="data[mobile]" id="textfield19" style="width:284px;"/></td>
          </tr>
          <tr>
            <td>E-mail：
              <input type="text" name="data[mail]" id="textfield20" style="width:227px;"/></td>
            <td>Q Q：
              <input type="text" name="data[qq]" id="textfield21" style="width:288px;"/></td>
          </tr>
          <tr>
            <td height="50" colspan="2">是否来过日本：
              <input type="text" name="data[is_went]" id="textfield22" style="width:90px;"/>
如有请填写理由及时间 ：
              <input type="text" name="data[went_detail]" id="textfield23" style="width:308px;"/></td>
          </tr>
          <tr>
            <td>是否参加过日语级别考试：<input type="text" name="data[is_exam]" id="textfield24" style="width:90px;"/><br /></td>
            <td>能力等级：<input type="text" name="data[exam_level]" id="textfield25" style="width:267px;"/></td>
          </tr>
          <tr>
            <td>如有请填写级别考试名称：</td>
            <td>参考时间：
              <input type="text" name="data[exam_time]" id="textfield26" style="width:267px;"/></td>
          </tr>
          <tr>
            <td height="50"><input type="text" name="data[exam_name]" id="textfield27" style="width:267px;"/></td>
            <td height="50">分数：
            <input type="text" name="data[exam_grade]" id="textfield28" style="width:291px;"/></td>
          </tr>
          <tr>
            <td rowspan="2">是否学习过日本语：<br />
            <input type="text" name="data[is_learn]" id="textfield29" style="width:267px;"/></td>
            <td>学习时间：
              <input type="text" name="data[learn_time]" id="textfield30" style="width:267px;"/></td>
          </tr>
          <tr>
            <td height="50">学校名称：
              <input type="text" name="data[learn_school]" id="textfield31" style="width:267px;"/></td>
          </tr>
          <tr>
            <td rowspan="3">高中学校名称：<br />
            <input type="text" name="data[high_school]" id="textfield32" style="width:267px;"/></td>
            <td>类型：
              <input type="text" name="data[learn_type]" id="textfield33" style="width:167px;"/>
              （文科/理科/艺术生）</td>
          </tr>
          <tr>
            <td>高考分数：
              <input type="text" name="data[high_exam_grade]" id="textfield34" style="width:267px;"/></td>
          </tr>
          <tr>
            <td height="50">毕业时间：
              <input type="text" name="data[graduation]" id="textfield35" style="width:267px;"/></td>
          </tr>
          <tr>
            <td rowspan="4">大学/大专名称：<br />
            <input type="text" name="data[college]" id="textfield36" style="width:267px;"/></td>
            <td>毕业院校种类：
              <input type="text" name="data[college_type]" id="textfield37" style="width:244px;"/></td>
          </tr>
          <tr>
            <td>是否有学位证：
              <input type="text" name="data[is_diploma]" id="textfield38" style="width:244px;"/></td>
          </tr>
          <tr>
            <td>所学专业：
              <input type="text" name="data[major]" id="textfield39" style="width:267px;"/></td>
          </tr>
          <tr>
            <td height="50">毕业时间：
              <input type="text" name="data[college_graduation]" id="textfield40" style="width:267px;"/></td>
          </tr>
          <tr>
            <td>意向院校(语言学校名称)：<br />
              <input type="text" name="data[intention]" id="textfield41" style="width:267px;"/>              <br /></td>
            <td>入学时间：（例2015年4月）<br />
            <input type="text" name="data[admission]" id="textfield42" style="width:267px;"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="button" id="button" value="提 交" class="tj"/>　　<input type="reset" name="button" id="button" value="重 置" class="cz"/></td>
          </tr>
        </table>
      </form>
      </div>
    </div>
  </div>
  <div class="cl"></div>
</div>
<script type="text/javascript" src="/cn/js/checkfrm.js"></script>
<!--内容结束-->