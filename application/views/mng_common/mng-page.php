                <div class="row-2">
                  <button class="btn btn-default" onclick="page($('[data-name=pageInput]').val())">跳转</button>
                  <input data-name="pageInput" class="form-control" />
                  <button class="btn btn-default" onclick="page('<?php echo $get['page'] + 1 ?>')" data-toggle="tooltip" title="下一页"><i class="fa fa-angle-double-right"></i></button>
                  <button class="btn btn-default" onclick="page('<?php echo $get['page'] - 1 ?>')" data-toggle="tooltip" title="上一页"><i class="fa fa-angle-double-left"></i></button>
                  <label><?php echo $get['page'] ?>/<?php echo $max_page ?></label>
                </div>
                <script>
                  $('[data-name="pageInput"]').bind('keydown', function(event){
                    if(event.keyCode == 13) {
                      page(this.value);
                    }
                  });
                </script>