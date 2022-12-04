@props(['product'])
<div id="carouselExampleIndicators{{$product->id}}" div data-ride="carousel" class="carousel slide" data-interval="0">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators{{$product->id}}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators{{$product->id}}" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators{{$product->id}}" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner"  data-interval="0">
      <div class="carousel-item active">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU" class="d-block w-100 " alt="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU">
      </div>
      <div class="carousel-item">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU" class="d-block w-100 " alt="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU">
      </div>
      <div class="carousel-item">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU" class="d-block w-100 " alt="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$product->id}}" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$product->id}}" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>  