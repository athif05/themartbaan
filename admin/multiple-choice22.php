<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<style>
    
    .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
    width: 100% !important;
}
</style>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<select name="pharmaceuticals[]" id="pharmaceuticals" class="selectpicker" multiple data-live-search="true">
  <option value=""></option>
    <?php
        for($e=1;$e<count($pharmaceuticalsArray);$e++) {
            
            if(isset($productLine['pharmaceuticals'])){
                $pharmaArray=explode(',',$productLine['pharmaceuticals']);
            }
    ?>
    <option value="<?php echo $e;?>" <?php if(isset($productLine['pharmaceuticals'])){ if(in_array($e, $pharmaArray)){ echo "selected";}}?>>
        <?php echo $pharmaceuticalsArray[$e];?>
    </option>
    <?php } ?>
</select>