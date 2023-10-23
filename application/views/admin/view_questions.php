<?php 
	$id = intval($_GET['id']);
	if(!isset($id) || $id == 0)
	{
		header('Location: view_manage_surveys.php');
		exit();
	}
?>

<!-- MAIN -->
<div id="main">
    <!-- container -->
    <div class="bg">
        <!-- row -->
        <div class="row">
            <div class="col-md-12 col-xs-12"><!-- col-md-9 -->
                <div class="content-header">
                    <?php if ($this->Model_questions->get_survey_info($id, 'name') == true) { ?>
                        <h1 color = "#4172a5!important"><?php echo $this->Model_questions->get_survey_info($id, 'name'); ?></h1>
                        <?php
                        if ($this->Model_questions->check_reset_admin_IP($id)) {
                            echo '<p><a href="#" class="survey-reset" id="' . $id . '">Reset took survey</a> for this survey</p>';
                        }
                        if ($this->Model_questions->get_survey_info($id, 'password') !== 'NULL') {
                            echo '<p>The password to access this survey is: ' . $this->Model_questions->get_survey_info($id, 'password') . '</p>';
                        }
                        ?>
                    <?php } else {
                        // not valid survey id and not valid id 
                        header('Location: view_manage_surveys.php');
                        exit();
                    } ?>
                </div>
                <!-- MAIN CONTENT -->
                <div id="main-content" style = "padding : 15px">
                    <div class="notice_messages"></div>
                    <div class="box box-info">
                        <div class="header" style = "padding : 10px">
                            <h3 class="sec_title">Questions
                                </h3>
                                <a class="btn btn-xs btn-primary pull-right" style = "margin-left: 10px" href="#addQuestion" data-toggle="modal">Add Question</a>
                                <a class="btn btn-xs btn-primary pull-right me-2" href="#orderQuestions" data-toggle="modal">Order Questions</a>
                        </div>
                        <div class="content">
                            <?php if ($this->Model_questions->listQuestions($id) == true) { ?>
                                <table id="example1" class="table table-bordered table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Fill</th>
                                            <th>Question</th>
                                            <th>Order</th>
                                            <th>Question Type</th>
                                            <th>Required</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (($this->Model_questions->listQuestions($id)) as $v) { ?>
                                            <tr>
                                                <td class="w-30">
                                                    <?php
                                                    if ($this->Model_questions->answer_exists($v->question_ID)) {
                                                        echo '<span class="glyphicon glyphicon-ok"></span>';
                                                    } else {
                                                        echo '<span class="glyphicon glyphicon-remove"></span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>admin/answers?id=<?php echo $v->question_ID; ?>?sid=<?php echo $id;?>" title="View Answers"><?php echo $v->questions; ?></a></td>
                                                <td class="w-60"><?php echo $v->order; ?></td>
                                                <td class="w-130"><?php echo $this->Model_questions->question_types[$v->question_type]; ?></td>
                                                <td class="w-60"><?php echo $this->Model_questions->yesNo($v->requeriment); ?></td>
                                                <td class="w-60">
                                                        <a class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>admin/answers?id=<?php echo $v->question_ID; ?>?sid=<?php echo $id;?>" title="View Answers">View</a>
                                                        <a class="btn btn-primary btn-xs" href="#editQuestion_<?php echo $v->question_ID; ?>" data-toggle="modal" title="Edit Question" data-question="<?php echo $v->questions; ?>" data-id="<?php echo $v->question_ID; ?>" data-q-type="<?php echo $v->question_type; ?>" data-q-req="<?php echo $v->requeriment; ?>" id="editAction">Edit</a>
                                                        <a class="btn btn-danger btn-xs" href="#deleteQuestion_<?php echo $v->question_ID; ?>" data-toggle="modal" title="Remove Question" data-question="<?php echo $v->questions; ?>" data-id="<?php echo $v->question_ID; ?>" id="deleteAction">Delete</a>
                                                </td>
                                            </tr>
                                            <!-- editQuestion Modal -->
                                            <div id="editQuestion_<?php echo $v->question_ID; ?>" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style = "padding : 30px">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Edit: <span id="questionTitle"></span></h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form id="edit-question" class="modal-body" action = "<?php echo base_url(); ?>admin/questions/edit_question" method="post">
                                                            <div class="notice_messages"></div>
                                                            <div style = "margin-bottom : 30px">
                                                                <label for="new-question" class="form-label">Question:</label>
                                                                <textarea class="form-control" id="new-question" name="new-question" placeholder = "<?php echo $v->questions;?>"></textarea>
                                                            </div>
                                                            <div style = "margin-bottom : 30px">
                                                                <label for="question-type" class="form-label">Question Type:</label>
                                                                <select class="form-control" id="question-type" name="question-type">
                                                                    <?php echo $this->Model_questions->render_question_types_selects(); ?>
                                                                </select>
                                                            </div>
                                                            <div style = "margin-bottom : 30px">
                                                                <label class="form-label" style = "margin-right : 30px">Required Question?</label>
                                                                <?php echo $this->Model_questions->render_question_requeriment($id, 'Not Required', 'Required'); ?>
                                                                <p class="hint"> Hint: Required question are questions that the user must answer to it in order to continue to next questions</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" id="survey_id" name="survey_id" value="<?php echo $id; ?>" />
                                                                <input type="hidden" id="id" name="id" value="<?php echo $v->question_ID; ?>" />
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="edit-question" data-option="edit-question" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- deleteQuestion Modal -->
                                            <div id="deleteQuestion_<?php echo $v->question_ID; ?>" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content"  style = "padding : 30px">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Delete <span id="questionTitle"></span></h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form id="delete-question" class="modal-body" action = "<?php echo base_url(); ?>admin/questions/delete_question" method="post">
                                                            <div class="notice_messages"></div>
                                                            <p>By deleting this question you will also delete its statistics and answers.</p>
                                                            <p>Are you sure you want to delete this question?</p>
                                                            <div class="modal-footer">
                                                            <input type="hidden" id="survey_id" name="survey_id" value="<?php echo $id; ?>" />
                                                            <input type="hidden" id="id" name="id" value="<?php echo $v->question_ID; ?>" />
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" name="delete-question" data-option="delete-question" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p class="pad20 pb-0 mb-0">No Questions found</p>
                                <p class="pad20">There are no questions to this survey. First you need to <a data-toggle="modal" href="#addQuestion">add a question</a></p>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- addQuestion Modal -->
                    <div id="addQuestion" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Add Question</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form id="add-question" class="modal-body" method = "post"  action = "<?php echo base_url(); ?>admin/questions/add_question">
                                    <div class="notice_messages"></div>
                                    <div class="mb-3">
                                        <label for="new-question" class="form-label">Question:</label>
                                        <textarea type ="input" class="form-control" id="new-question" name="new-question"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="question-type" class="form-label">Question Type:</label>
                                        <select class="form-control" id="question-type" name="question-type">
                                            <?php
                                                foreach($this->Model_questions->question_types as $name => $value) 
                                                {
                                                    echo '<option value="'.$name.'">'.$value.'</option>';    
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Required Question?</label>
                                        <label class="form-check-label" for="not-required">
                                            <input class="form-check-input" type="radio" id="not-required" name="requeriment" value="0" checked="checked"> Not Required
                                        </label>
                                        <label class="form-check-label" for="required">
                                            <input class="form-check-input" type="radio" id="required" name="requeriment" value="1"> Required
                                        </label>
                                        <p class="hint">Hint: Required question are questions that the user must answer to it in order to continue to next questions</p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="survey_id" name="survey_id" value="<?php echo $id; ?>" />
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" name="add-question" data-option="add-question" class="btn btn-primary">Add Question</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Order Questions -->
                    <div id="orderQuestions" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title text-white" style = "color : white">Order Questions</h3>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form id="order-questions" class="modal-body">
                                    <div class="box box-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Template Questions Sorting</h3>
                                        </div>
                                        <div class="content">
                                            <ul id="sortList">
                                                <?php if($this->Model_questions->listSortableQuestions($id)):
                                                foreach($this->Model_questions->listSortableQuestions($id) as $v) { ?>
                                                <li id="recordsArray_<?php echo $v->question_ID; ?>" class="list-group-item"><?php echo $v->questions; ?></li>
                                                <?php }
                                                else:
                                                echo '<p class="p-4">No questions to sort.</p>';
                                                endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php if($this->Model_questions->listSortableQuestions($id)): ?>
                                    <div class="panel-footer">
                                        <button type="submit" name="order-questions-confirm" data-option="order-questions-confirm" class="btn btn-primary">Confirm Changes</button>
                                    </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-md-9 -->
        </div>
        <!-- // row -->
    </div>
    <!-- // container -->
</div>
<!-- // MAIN -->