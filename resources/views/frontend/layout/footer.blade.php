<footer>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-lg-3 footer">
          <h4>Useful Links</h4>
          <div class="footer_body useful_link">
            <ul>
              <li>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <a target="_blank" href="https://moecdc.gov.np/"> CDC </a>
              </li>
              <li>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <a target="_blank" href="http://ctevt.org.np/"> CTEVT </a>
              </li>
              <li>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <a target="_blank" href="#"> NEP </a>
              </li>
              <li>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <a target="_blank" href="#"> doe.gov.np </a>
              </li>

              <li>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <a target="_blank" href="https://www.biratnagarmun.gov.np/en"> Biratnagar Metropolitan City </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-5 col-lg-5 footer quick_links">
          <h4>Contact Us</h4>
          <div class="footer_body">
            <div class="">
              <b> Admissions </b>
              <p>
                Phone No : +977 021-522647 <br />
                Email : admission@adarshaschool.edu.np
              </p>
            </div>

            <div class="">
              <b> Administration </b>
              <p>
                Phone No : +977 021-522647 <br />
                Email : admission@adarshaschool.edu.np
              </p>
            </div>
            <div class="">
              <b> Principal </b>
              <p>
                Phone No : +977 021-522647 <br />
                Email : admission@adarshaschool.edu.np
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 footer">
          <h4>Address</h4>
          <div class="footer_body">
            <p>
              <b> Adarsha Secondary School</b> <br />
              Biratnagar-9, Morang, Nepal <br />
              Post Box
            </p>
          </div>
          <div class="footer_body">
            Visitor Count: <br />
            <p>
               <span> {{ App\Models\visitor::count() }} </span>
 <br />
            
            </p>
          </div>
          <div class="footer_body footer_social">
            <ul>
              <li>
                <a href="" target="_blank">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a href="" target="_blank">
                  <i class="fa-brands fa-twitter"></i>
                </a>
              </li>
              <li>
                <a href="" target="_blank">
                  <i class="fa-brands fa-instagram"></i>
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          @ Godawari 2020. All Rights Reserved.
        </div>
        <div class="col-lg-6 col-md-6 powerby">
          Power by: <a href="#" target="_blank">Sarathi Technosoft</a>
        </div>
      </div>
    </div>
  </div>
  <!-- :: Scroll Up -->
  <div class="scroll-up">
    <a href="#page" class="move-section">
      <i class="fa-solid fa-arrow-up-to-line"></i>
    </a>
  </div>

  <!-- Script Include -->
  

  <script src="{{ asset("assets/js/jquery.js") }}"></script>
  <script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
  <script src="{{ asset("assets/js/owl.carousel.min.js") }}"></script>
  <script src="{{ asset("assets/js/main.js") }}"></script>
  <script src="{{ asset("assets/js/jquery.magnific-popup.min.js") }}"></script>
  <script>
    $(".gimg").magnificPopup({
      type: "image",
      gallery: {
        enabled: true,
      },
    });
  </script>
</body>
</html>