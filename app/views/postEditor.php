<?php
$postData = $this->post;
?>

<form id="article" action="<?= indexURL ?>index.php/post/save" method="POST">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Article Title" aria-label="Article Title" name="title" value ="<?= $postData['title']?>">
    </div>
    <div id="summernote"><?= $postData['content']?></div>
    <textarea style="display: none;" id='htmlValue' name='content' rows="4" cols="50"></textarea>
    <input type="hidden" name="post_id" value="<?= $postData['id']?>">
    <button class="btn btn-primary" onclick="saveData();" name ="save">Save</button>
</form>

<script>
      $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 300
      });
    function saveData(){
        var markupStr = $('#summernote').summernote('code');
        document.getElementById('htmlValue').innerHTML = markupStr;
        $("#article").submit();
    };
</script>
