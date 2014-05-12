<?
	class page{
		public $pageId;//页id
		public $onePageCount;//每一页显示记录数
		public $pageCount;//总数
		public $pageOrder;//页面链接,带参数
		public $pageNum;//总页数
		public $suffix;//伪静态后缀
		function page($pageId,$onePageCount,$pageCount,$pageOrder,$pg=0){
			$this->pageId = $pageId;
			$this->onePageCount = $onePageCount;
			$this->pageOrder = $pageOrder;
			$this->pageCount = $pageCount;
			$this->pageNum = getIntMax($this->pageCount/$this->onePageCount,2);
			if($this->pageId==""){$this->pageId=1;}
			if($pg==1){
				$this->suffix = ".html";
			}else{
				if(strstr($this->pageOrder,"?")){
					if(strstr($this->pageOrder,"?pageId=")){
						$this->pageOrder = getSplit($this->pageOrder,"?pageId=",0)."?pageId=";	
					}else{
						$this->pageOrder = getSplit($this->pageOrder,"&pageId=",0)."&pageId=";	
					}
				}else{
					$this->pageOrder = 	getSplit($this->pageOrder,"?pageId=",0)."?pageId=";
				}
			}	
		}
		function limitStart(){//limit开始
			return ($this->pageId*$this->onePageCount-$this->onePageCount);	
		}
		function limitEnd(){
			return ($this->onePageCount);	
		}
		function homePage($text){
			if($this->pageId==1){
				return ("<a href='javascript:;'>".$text."</a>");
			}else{
				return ("<a href=".$this->pageOrder."1".$this->suffix.">".$text."</a>");	
			}
		}
		function endPage($text){
			if($this->pageId==getIntMax($this->pageCount/$this->onePageCount,2)||$this->pageCount==0){
				return ("<a href='javascript:;'>".$text."</a>");
			}else{
				return("<a href=".$this->pageOrder.getIntMax($this->pageCount/$this->onePageCount,2).$this->suffix.">".$text."</a>");
			}
		}
		function upPage($text){
			if($this->pageId<=1){
				return ("<a href='javascript:;'>".$text."</a>");
			}else{
				return ("<a href=".$this->pageOrder.($this->pageId-1).$this->suffix.">".$text."</a>");
			}
		}
		
		function nextPage($text){
			if($this->pageId==getIntMax($this->pageCount/$this->onePageCount,2)||$this->pageCount==0){
				return ("<a href='javascript:;'>".$text."</a>");
			}else{
				return ("<a href=".$this->pageOrder.($this->pageId+1).$this->suffix.">".$text."</a>");
			}
		}
		
		function listPage($loopNun){
			$pageStr="";
			$bstrStart="<b>";
			$bstrEnd="</b>";
			$style="style='color:#000'";
			$tPageCount =getIntMax($this->pageCount/$this->onePageCount,2);//最大页号
			$tpageId = $this->pageId;//当前页号
			if(($loopNun-1) % 2==0){
				$thafyq = ($loopNun-1)/2;
				$thafyh = ($loopNun-1)/2;
			}else{
				$thafyq = intval(($loopNun-1)/2);
				$thafyh = ($loopNun-1)-intval(($loopNun-1)/2);
			}
			if($loopNun>$tPageCount){$loopNun=$tPageCount;}
			if($tPageCount<=$loopNun){
				for($i=1;$i<=$tPageCount;$i++){
					if($this->pageId!=$i){
						$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
					}else{
						$pageStr = $pageStr.$bstrStart."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>".$bstrEnd;
					}	
				}
			}else{
				if($tpageId<$loopNun){
					for($i=1;$i<=$loopNun;$i++){
						if($this->pageId!=$i){
							$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
						}else{
							$pageStr = $pageStr.$bstrStart."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>".$bstrEnd;
						}	
					}
				}else{
					if(($tpageId+$thafyh)<=$tPageCount){
						for($i=$tpageId-$thafyq;$i<=$tpageId+$thafyh;$i++){
							if($this->pageId!=$i){
								$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
							}else{
								$pageStr = $pageStr.$bstrStart."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>".$bstrEnd;
							}	
						}
					}else{
						for($i=$tpageId-$thafyq;$i<=$tPageCount;$i++){
							if($this->pageId!=$i){
								$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
							}else{
								$pageStr = $pageStr.$bstrStart."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>".$bstrEnd;
							}	
						}	
					}
				}
			}
			return $pageStr;
		}
		function listPage2($loopNun){
			$pageStr="";
			$bstrStart="<b>";
			$bstrEnd="</b>";
			$current=" class='current' ";
			$style="";
			$tPageCount =getIntMax($this->pageCount/$this->onePageCount,2);//最大页号
			$tpageId = $this->pageId;//当前页号
			if(($loopNun-1) % 2==0){
				$thafyq = ($loopNun-1)/2;
				$thafyh = ($loopNun-1)/2;
			}else{
				$thafyq = intval(($loopNun-1)/2);
				$thafyh = ($loopNun-1)-intval(($loopNun-1)/2);
			}
			if($loopNun>$tPageCount){$loopNun=$tPageCount;}
			if($tPageCount<=$loopNun){
				for($i=1;$i<=$tPageCount;$i++){
					if($this->pageId!=$i){
						$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
					}else{
						$pageStr = $pageStr."<a ".$current.$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
					}	
				}
			}else{
				if($tpageId<$loopNun){
					for($i=1;$i<=$loopNun;$i++){
						if($this->pageId!=$i){
							$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
						}else{
							$pageStr = $pageStr."<a ".$current.$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
						}	
					}
				}else{
					if(($tpageId+$thafyh)<=$tPageCount){
						for($i=$tpageId-$thafyq;$i<=$tpageId+$thafyh;$i++){
							if($this->pageId!=$i){
								$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
							}else{
								$pageStr = $pageStr."<a ".$current.$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
							}	
						}
					}else{
						for($i=$tpageId-$thafyq;$i<=$tPageCount;$i++){
							if($this->pageId!=$i){
								$pageStr = $pageStr."<a ".$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
							}else{
								$pageStr = $pageStr."<a ".$current.$style." href=".$this->pageOrder.$i.$this->suffix.">".$i."</a>";
							}	
						}	
					}
				}
			}
			return $pageStr;
		}
		function turnList ($text){//跳转
			$str="";
			$str = "&nbsp;&nbsp;<select id='turnpageselectsfjdkurfjdkajriewtieunv' name='turnpageselectsfjdkurfjdkajriewtieunv' onchange=location.href='".$this->pageOrder."'+this.value".$this->suffix." >";
			for($i=1;$i<=$this->pageNum;$i++){
				$str = $str."<option ".iif($this->pageId==$i,'selected','')." value=".$i.">".$i."</option>";
			}
			$str = $str ."</select>&nbsp;&nbsp;$text";
			return ($str);
		}
		function qtPage(){//常用默认认分页
			$str="";
			//$str=$str.("共".$this->pageNum."页&nbsp;&nbsp;");
	 		//$str=$str.("每页".$this->onePageCount."条&nbsp;&nbsp;");
			$str = $str."共".$this->pageCount."条信息 ";
     		$str=$str.($this->homePage("首页"));
			$str=$str.($this->upPage("上一页"));
			$str=$str.($this->listPage2(6));
			$str=$str.($this->nextPage("下一页"));
			$str=$str.($this->endPage("末页"));
			//$str = $str.($this->turnList("跳转"));
			return ($str);
		}
		function mPage(){//常用默认认分页
			$str="";
			$str=$str.("共".$this->pageNum."页&nbsp;&nbsp;");
	 		$str=$str.("每页".$this->onePageCount."条&nbsp;&nbsp;");
			$str = $str."共".$this->pageCount."条信息 ";
     		$str=$str.($this->homePage("首页"));
			$str=$str.($this->upPage("上一页"));
			$str=$str.($this->listPage(10));
			$str=$str.($this->nextPage("下一页"));
			$str=$str.($this->endPage("末页"));
			$str = $str.($this->turnList("跳转"));
			return ($str);
		}
		
		function mPageEn(){//常用默认认分页
			$str="";
			$str=$str.("Page&nbsp;&nbsp;".$this->pageNum."&nbsp;&nbsp;");
	 		$str=$str.("Record&nbsp;&nbsp;".$this->onePageCount."&nbsp;&nbsp;");
			$str = $str."One Page&nbsp;&nbsp;".$this->pageCount;
     		$str=$str.($this->homePage("Home"));
			$str=$str.($this->upPage("Previous"));
			$str=$str.($this->listPage(10));
			$str=$str.($this->nextPage("Next"));
			$str=$str.($this->endPage("Last"));
			$str = $str.($this->turnList("Go"));
			return ($str);
		}
		function gPage($str){
			if($str=="gb"){
				return ($this->mPage());	
			}else if($str=="en"){
				return ($this->mPageEn());	
			}	
		}
	}
?>