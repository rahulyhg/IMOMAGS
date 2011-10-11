<?php
/**
 * imo-tax-converter-options-page.tpl.php
 *
 * variables
 * $resp - the formatted response from form submissions.
 */
?>
<div class="wrap">
<h2>IMO Term Converter</h2>
<p>
    Converts old tags and categories in to the new taxonomy.
</p>
<?php if (!empty($resp)): ?>
<div id="response-pane" class="" style="background:#EFEFEF;color:#333; border-radius:5px;padding:5px 15px 10px;">
<?php print $resp; ?>
</div>
<?php endif; ?>
<form action="" method="post">
<p>
    
    <textarea cols='45' rows='9' name='taxonomy_match_data' ></textarea>
    
</p>
<p class="submit">
   <input class="button-primary" value="Submit" type="submit" />
</p>
</form>
</div>
