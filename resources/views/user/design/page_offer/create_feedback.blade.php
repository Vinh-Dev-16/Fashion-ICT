@if (Auth::check())
    <div id="review_form" class="review_form">
        <h4>Viết đánh giá của bạn</h4>
        <div class="form_review_user">
            <form class="user_review"
                  action=""
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="rating">
                    <p>Bạn có thấy hài lòng?</p>
                    <div class="rate_this">
                        <input type="radio" name="rate"
                               id="star5" value="5">
                        <label for="star5"><i
                                class="ri-star-fill"></i></label>
                        <input type="radio" name="rate"
                               id="star4" value="4">
                        <label for="star4"><i
                                class="ri-star-fill"></i></label>
                        <input type="radio" name="rate"
                               id="star3" value="3">
                        <label for="star3"><i
                                class="ri-star-fill"></i></label>
                        <input type="radio" name="rate"
                               id="star2" value="2">
                        <label for="star2"><i
                                class="ri-star-fill"></i></label>
                        <input type="radio" name="rate"
                               id="star1" value="1">
                        <label for="star1"><i
                                class="ri-star-fill"></i></label>
                    </div>
                    <div style="color:red;" class="text-danger error-text rate_error"></div>
                </div>
                <p style="margin-bottom: 20px">
                    <label>Tiêu đề</label>
                    <input type="text" name="title"
                           required>
                </p>
                <div style="color:red; margin-bottom: 15px" class="text-danger error-text title_error"></div>
                <p style="margin-bottom: 20px">
                    <label>Nội dung</label>
                    <textarea id="editor" cols="30" rows="15"
                              name="content"></textarea>
                </p>
                <div style="color:red; margin-bottom: 15px" class="text-danger error-text content_error"></div>
                <p>
                    <input type="text" hidden name="name"
                           value="{{ Auth::user()->name }}">
                    <input type="text" hidden name="email"
                           value="{{ Auth::user()->email }}">
                </p>
            </form>
            <button type="submit" onclick="send_feed_back({{ $product->id }})"
                    class="primary_button"
                    style="border:none; outline:none">
                Đánh giá
            </button>
        </div>
    </div>
@endif
