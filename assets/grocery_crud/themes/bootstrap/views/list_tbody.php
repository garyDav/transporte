<?php foreach($list as $num_row => $row){ ?>
    <tr>
        <td>
            <input type="checkbox" class="select-row" data-id="<?php echo $row->primary_key_value; ?>" />
        </td>
        <td>
                <div class="only-desktops"  style="white-space: nowrap">
                    <?php if(!$unset_edit){?>
                        <a class="btn btn-default" href="<?php echo $row->edit_url?>"><i class="fa fa-pencil"></i> <?php echo $this->l('list_edit'); ?></a>
                    <?php } ?>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Más
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                            if(!empty($row->action_urls)){
                                foreach($row->action_urls as $action_unique_id => $action_url){
                                    $action = $actions[$action_unique_id];
                                    ?>
                                    <li>
                                        <a href="<?php echo $action_url; ?>">
                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                        </a>
                                    </li>
                                <?php }
                            }
                            ?>
                            <?php if (!$unset_read) { ?>
                                <li>
                                    <a href="<?php echo $row->read_url?>"><i class="fa fa-eye"></i> <?php echo $this->l('list_view')?></a>
                                </li>
                            <?php } ?>
                            <?php if (!$unset_delete) { ?>
                                <li>
                                    <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row">
                                        <i class="fa fa-trash-o text-danger"></i>
                                        <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="only-mobiles">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <?php echo $this->l('list_actions'); ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo $row->edit_url?>">
                                    <i class="fa fa-pencil"></i> <?php echo $this->l('list_edit'); ?>
                                </a>
                            </li>
                            <?php
                            if(!empty($row->action_urls)){
                                foreach($row->action_urls as $action_unique_id => $action_url){
                                    $action = $actions[$action_unique_id];
                                    ?>
                                    <li>
                                        <a href="<?php echo $action_url; ?>">
                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                        </a>
                                    </li>
                                <?php }
                            }
                            ?>
                            <?php if (!$unset_read) { ?>
                                <li>

                                    <a href="<?php echo $row->read_url?>"><i class="fa fa-eye"></i> <?php echo $this->l('list_view')?></a>
                                </li>
                            <?php } ?>
                            <?php if (!$unset_delete) { ?>
                                <li>
                                    <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row">
                                        <i class="fa fa-trash-o text-danger"></i> <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
        </td>
        <?php foreach($columns as $column){?>
            <td>
                <?php 
                    $aux=substr($row->{$column->field_name},0,7);
                    if($aux==='<image>'):
                 ?>        <div class="thumbnails" data-toggle="lightbox">
                                <div class="span3">
                                    <a href="<?php echo substr_replace($row->{$column->field_name}, '', 0, 7)?>"class="thumbnail">
                                     <img width="150px"  src="<?php echo substr_replace($row->{$column->field_name}, '', 0, 7)?>" alt=""/>
                                    </a>
                                </div>
                          </div>
                           <!-- 

                           <script>
                            <a class="hi" data-toggle="modal" data-target="#myModal" data-img='<?php echo substr_replace($row->{$column->field_name}, '', 0, 7)?>'>
                                        <img src="<?php echo substr_replace($row->{$column->field_name}, '', 0, 7)?>" height="50px">
                                    </a>
                               $('.hi').click(function(){
                                    ruta=$(this).attr('data-img');
                                    $('#gthusho').attr("src",ruta)
                                })
                            </script>-->
                <?php else: ?>
                <?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ;?>
                <?php endif; ?>
            </td>
        <?php }?>
    </tr>
<?php } ?>
 <!-- Modal -->
                               <!--      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">                                               
                                                <div class="modal-body"> 
                                                    <img id="gthusho" src="" alt="" class="img-responsive"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                   