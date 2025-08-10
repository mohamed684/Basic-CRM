<h1>Create New Page</h1>

<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $err): ?>
        <p style="color: red;"><?= htmlspecialchars($err) ?></p>
    <?php endforeach; ?>
<?php endif; ?>


<form method="POST" action="index.php?route=admin/pages/create">

    <input type="hidden" name="_csrf" value="<?= csrf_token() ?>">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="slug">Slug:</label>
    <input type="text" name="slug" id="slug" required>

    <label for="content">Content:</label>
    <textarea type="text" name="content" id="content" rows="10"></textarea>

    <input type="submit" value="Submit">

</form>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/x1va1xofc0cjiysdnm26tb6ms73qe19g5yev23qe9dywd959/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Aug 24, 2025:
      'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    uploadcare_public_key: '142e9b7b71e28358d2d8',
  });
</script>
