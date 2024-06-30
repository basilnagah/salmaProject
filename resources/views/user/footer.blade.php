<?php 
use App\Models\AppSetting;

    $footerData = AppSetting::all();

    if($footerData)
    {
        foreach ($footerData as $data)
        {
            if($data->key == 'address') {
                $address = $data;
            } elseif ($data->key == 'Whatsapp') {
                $whatsapp = $data;
            } elseif ($data->key == 'instgram') {
                $instgram = $data;
            } elseif ($data->key == 'facebook') {
                $facebook = $data;
            } elseif ($data->key == 'ReturnPolicy') {
                $ReturnPolicy = $data;
            } elseif ($data->key == 'shippingPolicy') {
                $shippingPolicy = $data;
            }
        }
    }
?>
<div class="footer">
    <footer class="site-footer">
        <hr>
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved salma store
                    </p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <ul>
                        @if (isset($ReturnPolicy))
                        {{-- <li> <a href="{{ url('ergaa') }}">سياسة الاسترجاع</a></li> --}}
                        <li> <a href="{{ route('appSettings.ReturnPolicy')}}">سياسة الاسترجاع</a></li>
                        @endif

                        @if (isset($shippingPolicy))     
                        {{-- <li> <a href="{{ url('shaan') }}">سياسة الشحن</a></li> --}}

                        <li> <a href="{{ route('appSettings.shippingPolicy') }}">سياسة الشحن</a></li>
                        @endif

                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class=" social-icons">
                        @if (isset($facebook))
                            <a class="facebook" href="{{$facebook->title}}"
                                target="_blank"><i class="fa-brands fa-facebook fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #1877F2;"></i></a>
                            {{-- <a class="facebook" href="https://www.facebook.com/salmastore2023?mibextid=ZbWKwL"
                                target="_blank"><i class="fa-brands fa-facebook fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #1877F2;"></i></a> --}}
                        @endif

                        @if (isset($instgram))
                            <a class="instagram" href="{{$instgram->title}}"
                                target="_blank"><i class="fa-brands fa-instagram fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #E4405F;"></i></a>
                            {{-- <a class="instagram" href="https://instagram.com/salmastore7?igshid=MTI1ZDU5ODQ3Yw=="
                                target="_blank"><i class="fa-brands fa-instagram fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #E4405F;"></i></a> --}}
                        @endif
                        
                        {{-- <a class="telegram" href="https://t.me/salmastore81" target="_blank"><i
                                class="fa-brands fa-telegram fa-beat-fade fa-lg ms-2 me-2"
                                style="color: #0088cc;"></i></a> --}}
                        @if (isset($whatsapp))
                            <i class="fa-brands fa-whatsapp fa-beat-fade fa-lg ms-2 me-2 d-inline" style="color: #49c173;">
                                <P class="d-inline">{{$whatsapp->title}}</P>
                            </i>
                            {{-- <i class="fa-brands fa-whatsapp fa-beat-fade fa-lg ms-2 me-2 d-inline" style="color: #49c173;">
                                <P class="d-inline">+201050883058</P>
                            </i> --}}
                        @endif

                        @if (isset($address))
                            <li class="mt-3 enwan">{{$address->title}}</li>
                            {{-- <li class="mt-3 enwan">٢٨ جسر سويس مول براند مول برج الايمان القاهرة</li> --}}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user/js/product.js') }}"></script>
</body>

</html>
