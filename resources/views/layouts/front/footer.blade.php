<footer class="footer-secation footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">

                <ul class="footer-menu">
                    <li>  <a href="{{ route('accounts'), ['tab'] => 'profile' }}">You account</a></li>
                    <li> <a href="Contatus Us"></a> </li>
                    <li> <a href=""></a>Terman fo service</li>
                </ul>

                <ul class="footer-social">
                <li> <a href=""> <i class="fa fa-facebook" aria-hidden="true"></i>  </a> </li>
                    <li> <a href=""> <i class="fa fa-twitter" aria-hidden="true"></i>   </a> </li>
                    <li> <a href=""> <i class="fa fa-instagram" aria-hidden="true"></i>  </a> </li>
                    <li> <a href=""> <i class="fa fa-pinterest-p" aria-hidden="true"></i>  </a> </li>
                </ul>

                <p>&copy; <a href="http{{ config('app.url') }}">{{ config('app.name') }}</a>


            </div>
        </div>
    </div>



</footer>