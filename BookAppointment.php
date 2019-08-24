<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>kyd</title>
    <!-- Bootstrap.css version 4.3.1 CDN -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

     <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   <!-- Google Api -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://kit.fontawesome.com/94094e8e6a.js"></script>
   <!-- CSS FILE -->
   <link rel="stylesheet" type="text/css" href="css/bookAppointment.css">

   <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
  </head>
  <body>



 <div class="container">
            <div class="row">
              <div class="col-md-4 mr-0 pr-0 mx-0">
                  <div class="well-block">
                      <div class="well-title mb-0">
                          <h5>APPOINTMENT SUMMARY</h5>
                      </div>
                      <div class="feature-block col-md-12">
                            <img src="images/doc1.jpg" class="img-fluid col-md-10" alt="">
                            <label class="" for="" id="Docname" style="color:#204969; font-weight:bold;">Dr.Sabreena Shah</label>
                            <label class="" for="" id="Post">Director - Hematology/Hemato-oncology</label>
                      </div>
                      <div class="time-block row ml-0 col-md-12 ">
                        <i class="far fa-calendar-alt fa-2x col-md-1 mt-2" style="color:#204969;"></i>
                        <div class="col-md-10">
                          <label for="" id="date" class="w-100 mb-0" style="color:#204969; font-weight:bold;">Fri-19 Jul, 2019</label> <br>
                          <label for="" id="time" class="mt-0 pt-0">16:00 PM</label>
                        </div>


                      </div>
                      <div class="location-block row ml-0 col-md-12">
                        <i class="fas fa-map-marker-alt fa-2x col-md-1 mt-2"  style="color:#204969;"></i>
                          <div class="col-md-10 pr-0">
                        <label for="" id="Address" style="font-size:13px;">Max Super Speciality Hospital, 108A, I.P.Extension, Patparganj, New Delhi, Delhi, India , Pincode-110092</label>
                      </div>
                      </div>
                  </div>
              </div>
                <div class="col-md-8 ml-0 pl-0">
                    <div class="well-block">
                        <div class="well-title">
                            <h3 >Please fill in patient details below</h3>
                        </div>
                        <form>
                          <label for="">Name of the patient </label>


                            <!-- Form start -->
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <select class="form-control"  >
                                    <option value="All" selected="selected">Mr.</option>
                                    <option >Mrs.</option>
                                    <option>Ms.</option>
                                    <option>Dr.</option>
                                    <option>Baby</option>
                                    <option>Mast.</option>
                                </select>
                              </div>
                            </div>
                            <!-- First name -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="fname" name="name" type="text" placeholder="First Name" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Last name -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="lname" name="name" type="text" placeholder=" Last  Name" class="form-control input-md">
                                    </div>
                                </div>

                                   <!-- Gender -->
                        <div class="col-md-3">

                            <div class="form-group">
                               <label for=""> Gender </label><br>
                             </div>
                              </div>


                                <div class="col-md-3">

                                       <div class="form-group">
                                           <input type="radio" name="Male" value="Male" >Male
                                     </div>
                                      </div>

                                      <div class="col-md-3">
                                             <div class="form-group">
                                                 <input type="radio" name="Female" value="Female" >Female
                                           </div>
                                            </div>

                                            <div class="col-md-3">
                                                   <div class="form-group">
                                                       <input type="radio" name="other" value="other" >Other
                                                 </div>
                                                  </div>

                              <!-- Birthdate -->
                              <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label" for="email">Birth Date</label><br>
                                     <input id="bdate" name="bdate" type="date"  class="form-control input-md">
                                     </div>
                                   </div>

                                <!-- Email-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Email</label>
                                        <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md">
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="date">Phone Number</label>
                                        <input id="phone" name="phone" type="number" placeholder="Phone Number" class="form-control input-md">
                                    </div>
                                </div>

                                <!-- Select Basic -->
                                <div class="col-md-12">
                                    <div class="form-group money px-3 py-2">
                                      <h6 class="m-0 p-0">Total Amount (Doctor Consultation Charges)
                                        <label class="control-label" id="cost"> INR 1000</label>
                                      </h6>

                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button id="buttonNow" name="singlebutton" class="btn btn-primary">Book & Pay now</button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button id="buttonLater" name="singlebutton" class="btn btn-primary">Book & Pay At Hospital</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- form end -->
                    </div>
                </div>

            </div>
        </div>
        <div class="bottom-img"><img src="images/step-3-bg.jpg" class="col-md-12 img-fluid m-0 mt-3 p-0" alt=""></div>

</body>
</html>
