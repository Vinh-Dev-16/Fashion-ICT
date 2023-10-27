@extends('user.layout')
@section('title')
    Sửa địa chỉ của {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="form_information">
        <div class="container_information">
            <div class="title">Thêm địa chỉ</div>
            <div class="content">
                <form>
                    <div class="user-details">
                        <div class="input-box" style="width: 100%">
                            <span class="details">Chọn tỉnh/thành phố</span>
                            <select class="form-control" style="width: 100%" id="show-province"
                                    onchange="province(value)">
                                <option selected disabled>

                                </option>
                            </select>
                        </div>
                        <div style="color:red;" class="text-danger error-text province_error"></div>
                        <div class="input-box" style="width: 100%">
                            <span class="details">Chọn huyện</span>
                            <select class="form-control" style="width: 100%; height: 45px" id="show-district"
                                    onchange="district(value)">
                                <option selected disabled>

                                </option>
                            </select>
                        </div>
                        <div style="color:red;" class="text-danger error-text district_error"></div>
                        <div class="input-box" style="width: 100%">
                            <span class="details">Chọn xã</span>
                            <select class="form-control" style="width: 100%" id="show-commune">
                                <option selected disabled>

                                </option>
                            </select>
                        </div>
                        <div class="input-box" style="width: 100%;">
                            <span class="details">Địa chỉ</span>
                            <input type="text" name="address" style="width: 82%" value="{{$user->information->address}}">
                        </div>
                    </div>
                    <div style="color:red;" class="text-danger error-text address_error"></div>
                </form>
                <button id="edit_address" style="border: none; outline: none" type="submit" class="primary_button">
                    Sửa địa chỉ
                </button>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @include('user.design.information.script')

    @include('user.design.information.edit_script')
@endsection
