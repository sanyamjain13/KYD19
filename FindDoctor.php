<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KYD</title>

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

    <!-- CSS FILE -->
    <link rel="stylesheet" type="text/css" href="css/findDoctor.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">

  </head>


  <body>

    </script>
    <?php
      include 'header.php'
    ?>

    <script>
      function sendvalues()
      {
        var e = document.getElementById("sel1");
        var var1 = e.options[e.selectedIndex].text;

        var d = document.getElementById("sel2");
        var var2 = d.options[d.selectedIndex].text;

        window.location='slots.php?Speciality='+var1+'&Hospital='+var2;

        // alert(var1);
        // alert(var2);        //window.location='abc.php?x=var1&y=var2';
      }
    </script>
    <!-- <p class="heading">FIND A DOCTOR</p> -->

    <img src="images/doc.png" alt="" class="bg">

    <div class="selector">
    <div class="row ">
    <h3>Find the perfect doctor to fit your needs.</h3>
    <div class="form-group col-md-3 sel">
    <label for="sel1">Speciality</label>
    <select class="form-control"  id="sel1">
    <option value="All" selected="selected">Specialty</option>
    <option value="19691">Advanced Heart Failure &amp; Transplant Cardiology</option>
    <option value="19826">Allergy &amp; Immunology</option>
    <option value="19906">Bariatric Surgery</option>
    <option value="19866">Cardiac Electrophysiology</option>
    <option value="19706">Cardiology</option>
    <option value="20396">Cardiothoracic Anesthesiology</option>
    <option value="19611">Cardiothoracic Surgery</option>
    <option value="20766">Child &amp; Adolescent Psychiatry</option>
    <option value="19831">Clinical Neurophysiology</option>
    <option value="19796">Clinical Psychology</option>
    <option value="19891">Colon &amp; Rectal Surgery</option>
    <option value="20951">Critical Care</option>
    <option value="19756">Dentistry &amp; Maxillofacial Surgery</option>
    <option value="19896">Dermatology</option>
    <option value="19626">Diagnostic Radiology</option>
    <option value="19741">Emergency Medicine</option>
    <option value="19901">Endocrinology Diabetes &amp; Meta</option>
    <option value="19846">Family Medicine</option>
    <option value="19711">Gastroenterology</option>
    <option value="19606">General Surgery</option>
    <option value="21181">Geriatric Medicine</option>
    <option value="19871">Gynecologic Oncology</option>
    <option value="19961">Gynecology</option>
    <option value="19621">Hematology &amp; Oncology</option>
    <option value="19996">Hospice &amp; Palliative Care</option>
    <option value="20111">Hospital Medicine</option>
    <option value="19716">Infectious Disease Medicine</option>
    <option value="19661">Internal Medicine</option>
    <option value="19811">Internal Medicine &amp; Pediatrics</option>
    <option value="19876">Interventional Cardiology</option>
    <option value="19801">Interventional Radiology</option>
    <option value="19956">Maternal-Fetal Medicine</option>
    <option value="19921">Medical Genetics</option>
    <option value="20861">Medical Toxicology</option>
    <option value="19641">Neonatal Medicine</option>
    <option value="19596">Nephrology</option>
    <option value="20791">Neuro-Ophthalmology</option>
    <option value="20886">Neurological Skull Base Surgery</option>
    <option value="19601">Neurology</option>
    <option value="19666">Neuroradiology</option>
    <option value="19581">Neurosurgery</option>
    <option value="19771">Nuclear Medicine</option>
    <option value="21101">Nurse Practitioner</option>
    <option value="19546">Obstetrics &amp; Gynecology</option>
    <option value="19686">Ophthalmology</option>
    <option value="21061">Ophthalmology Retina Surgery</option>
    <option value="20031">Oral &amp; Maxillofacial Surgery</option>
    <option value="21041">Orthopaedic Foot &amp; Ankle Surgery</option>
    <option value="20751">Orthopaedic Musculoskeletal Oncology</option>
    <option value="19936">Orthopaedic Spine Surgery</option>
    <option value="21046">Orthopaedics</option>
    <option value="19586">Orthopedic Hand Surgery</option>
    <option value="19886">Orthopedic Sports Medicine</option>
    <option value="19696">Orthopedic Surgery</option>
    <option value="19671">Otolaryngology &amp; Head &amp; Neck Surgery</option>
    <option value="20381">Pain Medicine</option>
    <option value="20246">Pediatric Anesthesiology</option>
    <option value="19636">Pediatric Cardiology</option>
    <option value="19766">Pediatric Critical Care Medicine</option>
    <option value="20001">Pediatric Dentistry</option>
    <option value="19746">Pediatric Emergency Medicine</option>
    <option value="19931">Pediatric Endocrinology</option>
    <option value="19881">Pediatric Gastroenterology</option>
    <option value="19651">Pediatric Hematology &amp; Oncology</option>
    <option value="19681">Pediatric Infectious Disease Medicine</option>
    <option value="19726">Pediatric Nephrology</option>
    <option value="19816">Pediatric Neurology</option>
    <option value="19736">Pediatric Neurosurgery</option>
    <option value="21201">Pediatric Pathology</option>
    <option value="19786">Pediatric Pulmonology</option>
    <option value="19911">Pediatric Surgery</option>
    <option value="19731">Pediatrics</option>
    <option value="20706">Pediatrics Orthopaedic Surgery</option>
    <option value="19551">Physical Medicine &amp; Rehabilitation</option>
    <option value="19591">Plastic Surgery</option>
    <option value="19541">Podiatry</option>
    <option value="19821">Psychiatry</option>
    <option value="19566">Pulmonary Disease &amp; Critical Care</option>
    <option value="19856">Pulmonary Transplantation (Non-Surgical)</option>
    <option value="19646">Radiation Oncology</option>
    <option value="21011">Radiology</option>
    <option value="19791">Reproductive Endocrinology and Infertility</option>
    <option value="19751">Rheumatology</option>
    <option value="19571">Sleep Medicine</option>
    <option value="19841">Surgery of the Hand</option>
    <option value="21206">Surgical Oncology</option>
    <option value="19971">Transplant Hepatology</option>
    <option value="19616">Transplant Surgery (Abdominal)</option>
    <option value="21196">Transplant Surgery (Abdominal) - PA</option>
    <option value="19721">Transplant Surgery (Cardiothoracic)</option>
    <option value="19761">Trauma Surgery</option>
    <option value="19861">Urogynecology</option>
    <option value="19656">Urology</option>
    <option value="20896">Vascular Neurology</option>
    <option value="19631">Vascular Surgery</option>
    </select>
    </div>

<!-- <div class="form-group col-md-2 sel">
<label for="sel1">Area of interest</label>
<select class="form-control" id="sel1">
<option value="All" selected="selected">Area of Interest</option>
<option value="19401">Appendix</option>
<option value="19496">Asthma/Bronchitis</option>
<option value="19446">Back Pain</option>
<option value="19481">Bariatric Surgery</option>
<option value="19431">Burns</option>
<option value="19386">Cancer</option>
<option value="19296">Cardiac Surgery</option>
<option value="19301">Cardiology</option>
<option value="19346">Cataracts/Implants</option>
<option value="20771">Cochlear Implants</option>
<option value="19371">Colorectal Cancer Screening</option>
<option value="20821">COPD</option>
<option value="19456">Coronary Disease</option>
<option value="19461">Dermatology</option>
<option value="19366">Diabetes</option>
<option value="19236">Digestive Disease</option>
<option value="19316">Ear Nose and Throat</option>
<option value="19436">Electrophysiology</option>
<option value="19471">Endocrinology</option>
<option value="19331">Epilepsy Seizure</option>
<option value="19241">Gall Bladder</option>
<option value="19261">General Medicine</option>
<option value="19246">General Surgery</option>
<option value="20811">Gynecological Cancer</option>
<option value="19356">Gynecology</option>
<option value="19506">Head and Neck Surgery</option>
<option value="19486">Head Trauma</option>
<option value="20346">Headache</option>
<option value="19291">Hematology</option>
<option value="19266">Hepatobiliary/Pancreas</option>
<option value="19251">Infectious Disease</option>
<option value="19361">Joint Replacement</option>
<option value="19306">Labor and Delivery</option>
<option value="19391">Male Reproductive System</option>
<option value="19376">Maternity Care</option>
<option value="19336">Mental Health</option>
<option value="19286">Neonatology</option>
<option value="19216">Nephrology</option>
<option value="19341">Neurodegenerative Disorders</option>
<option value="19441">Neurology</option>
<option value="19211">Neurosurgery</option>
<option value="19426">Newborn Care</option>
<option value="19381">Obstetrics</option>
<option value="19396">Oncology</option>
<option value="19351">Opthamology</option>
<option value="19276">Orthopedic Surgery</option>
<option value="19411">Orthopedics</option>
<option value="20796">Other</option>
<option value="20876">Pneumonia</option>
<option value="19406">Pulmonology</option>
<option value="19321">Reconstructive Surgery</option>
<option value="19326">Rehabilitation</option>
<option value="19451">Rheumatology</option>
<option value="19231">Spine Surgery</option>
<option value="19416">Stroke</option>
<option value="19421">Substance Abuse</option>
<option value="19256">Thoracic</option>
<option value="19221">Transplant</option>
<option value="19271">Trauma</option>
<option value="19226">Urology</option>
<option value="19281">Vascular</option>
</select>
</div> -->

<div class="form-group col-md-2 sel">
<label for="sel1">Hospital</label>
<select class="form-control" id="sel2">
<option value="All" selected="selected">Hospital Name</option>
<option>All India Institute of Medical Sciences</option>
<option>Holy Family  Hospital</option>
<option>Central Research Institute for Ayurveda</option>
<option>Ganga Ram HospitalMajidia Hospital</option>
<option>Majidia Hospital</option>
<option>B.L.Kapoor Memorial Hospital</option>
<option>Jessa Ram Hospital</option>
<option>Batra Hospital & Medical Research Centre </option>
<option>Jaipur Golden Hospital </option>
<option>Max Health Care Institute Ltd</option>
<option>Fortis Hospital</option>
<option>Metro Heart Institute</option>
<option>GB Pant Hospital</option>
<option>Mother & Child Hospital</option>
<option>Mohinder Hospital</option>
<option>Sitaram Bhartia Institute of Science & Research</option>
<option>Vasant Lok Hospital</option>
<option>Indraprastha Apollo Hospital</option>
<option>St.Stephens Hospital</option>
<option>Dharmshila Cancer Hospital and Research Centre</option>
</select>
</div>

<div class="form-group col-md-2  sel2">
  <br>
<button type="submit" name="submit" class="btn btn-primary b" onclick="sendvalues();">Search</button>
</div>


</div>

</div>
  </body>
</html>
