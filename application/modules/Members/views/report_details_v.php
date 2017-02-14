<div class="pull-right">
<?php
if($content) {
  echo '<button id="continue" class="btn btn-warning" value="'.$repID.'" style="border-radius: 0px;">Continue Report</button>';
}
else{
  echo '<button id="start" class="btn btn-primary" value="'.$repID.'" style="border-radius: 0px;">Start Report</button>';
}
?>
</div>
<div class="row">
  <div class="col-md-6">
    <h3>Report Title:</h3>
    <h4><?= @$title; ?></h4>
  </div>
  <div class="col-md-6">
    <div class="pull-right">
      <p>Created by: <?= @$name; ?></p>
    </div>
  </div>
  <div class="col-md-12">
    <h3>Report Description:</h3>
    <?= @$description; ?>
  </div>
</div>
<div class="row" style="margin-top: 1em;" id="edit-text-area">
  <div class="col-md-12">
    <div id="editor">
      <form role="form" id="report-content">
        <input type="hidden" name="repid" id="repid" value="<?= @$repID; ?>">
        <textarea id="edit" name="edit" style="margin-top: 30px;" placeholder="Type some text">
        <?= $content = ($content) ? @$content : null ; ?>
        </textarea>
        <div class="pull-right" style="margin-top: 0.5em;">
          <button id="save" type="submit" class="btn btn-success" value="1" style="border-radius: 0px;">Save</button>
          <button id="save-finish" type="submit" class="btn btn-primary" value="2" style="border-radius: 0px;">Save and Finish</button>
        </div>
      </form>
    </div>
  </div>
</div>
 
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/froala_editor.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/align.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/code_beautifier.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/code_view.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/draggable.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/image.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/image_manager.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/link.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/lists.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/paragraph_format.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/paragraph_style.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/table.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/video.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/url.min.js"></script>
<script src="<?= @$this->config->item('assets_url'); ?>plugins/froala/js/plugins/entities.min.js"></script>
<script>
  $(function(){
    $('#edit')
      .on('froalaEditor.initialized', function (e, editor) {
        $('#edit').parents('form').on('submit', function () {
          console.log($('#edit').val());
          return false;
        })
      })
      .froalaEditor({enter: $.FroalaEditor.ENTER_P, placeholderText: null})
  });


  $().ready(function(){
    $("#edit-text-area").hide();
    $("#start").click(function(){
      $("#edit-text-area").show({'fadeIn': 'down'});
      val = $(this).val();
      $.post("<?= @base_url('members/start_report'); ?>", {"reportID":val});
    });
    $("#continue").click(function(){$("#edit-text-area").show({'fadeIn': 'down'});});

    $("#save").click(function(e) {
      e.preventDefault();
      $reportContent = $("#report-content").serializeArray();

      var post = $.post("<?= @base_url('members/save_draft'); ?>",{"reportContent":$reportContent} );
      post.done(function(data){
        if (data) {
          window.location.assign("<?= @base_url('members'); ?>");
        }
      });
    });

    $("#save-finish").click(function(e) {
      e.preventDefault();
      $reportContent = $("#report-content").serializeArray();

      var post = $.post("<?= @base_url('members/save_complete'); ?>",{"reportContent":$reportContent} );
      post.done(function(data){
        window.location.assign("<?= @base_url('members'); ?>")
      });
    });
  });
</script>
