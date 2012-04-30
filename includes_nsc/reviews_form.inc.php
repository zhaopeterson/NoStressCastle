
<p>Be the first to review</p>

<form action="reviews.php" method="post" accept-charset="utf-8">
    <fieldset><legend>Review This Product</legend>	
    <p><label for="rating">Rating</label><input type="radio" name="rating"
      value="5" /> 5 <input type="radio" name="rating" value="4" /> 4
      <input type="radio" name="rating" value="3" /> 3 <input type="radio"
      name="rating" value="2" /> 2 <input type="radio" name="rating" value="1" /> 1</p>
    <p><label for="review">Review</label><textarea name="review" rows="8" cols="40">
       </textarea></p>
    <p><input type="submit" value="Submit Review" /></p>
    <input type="hidden" name="product_type" value="actual_product_type" id="product_type" />
    <input type="hidden" name="product_id" value="actual_product_id" id="product_id" />
</fieldset>
</form>

</div><!--end of review container-->
	
</div><!--end of product detail info container-->
</div><!--end of cake description container-->