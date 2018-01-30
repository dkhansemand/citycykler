<?php 
    $pagesData = PageContent::GetPagesWithContent();
?>
<link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
  <div class="mdl-tabs__tab-bar">
      <?php
        foreach($pagesData as $idx => $page)
        {
        ?>
            <a href="#<?=$page->pageName?>" class="mdl-tabs__tab <?= $idx === 0 ? 'is-active' : ''?>"><?=$page->pageName?></a>
        <?php
        }
      ?>
  </div>

  <?php
        foreach($pagesData as $idx => $page)
        {
    ?>
        <div class="mdl-tabs__panel <?= $idx === 0 ? 'is-active' : ''?>" id="<?=$page->pageName?>">
            <div id="toolbar">
            
            </div>
            <div id="editor" style="background-color:#fff;">
                <?=$page->pageText?>
            </div>
        </div>
    <?php } ?>
</div>
<pre>
    <?php //var_dump(PageContent::GetPagesWithContent());?>
</pre>
<script src="https://cdn.quilljs.com/1.2.6/quill.min.js"></script>
<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],
      
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
      
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
      
        ['clean']                                         // remove formatting button
      ];
      
      var quill = new Quill('#editor', {
        modules: {
          toolbar: toolbarOptions
        },
        theme: 'snow'
      });
</script>