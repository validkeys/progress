<div class="task-check-div">
<?php 
echo $this->Form->create('Task', array('url'=>array('controller'=>'tasks','action'=>'toggle','id'=>false,'class'=>'task-toggle-form')));
echo $this->Form->hidden('id', array('value'=>$task['id'],'div'=>false));

$opts = array('label'=>$task['title'],'div'=>false,'class'=>'task-check');

if($task['complete']){
	$opts['checked'] = 'checked';
}

echo $this->Form->input('complete', $opts);
echo $this->Form->end();	
 ?>
</div>