<div class="form-group product-image">
    <div class="row">
        <div class="col-md-4">
            <input type="file" name="newImages[{{$imageId}}]" class="custom-file-input" id="customFile2" style="opacity:1!important;">
        </div>
        <div class="col-md-2">
            <input type="checkbox" name="newImagesMain[{{$imageId}}]" value="1" class="generator" id="switch19">
            <span>
                  <label for="switch19"></label>
            </span>
        </div>
        <div class="col-md-2">
            <input type="checkbox" name="newImagesPreview[{{$imageId}}]" value="1" class="generator" id="switch19">
            <span>
                  <label for="switch19"></label>
            </span>
        </div>
        <div class="col-md-2">
            <input id="inputText4" name="newImagesOrdering[{{$imageId}}]" value="100" type="number" class="form-control" value="">
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger delete-image" type="button">Удалить</button>
        </div>
    </div>
    <hr>
</div>