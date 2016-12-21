<div class="containerContainer" id="education">
  <h1 class="page-header">Education</h1>
  <div class="contentContainer">
    <div class="row">
      <div class="col-lg-12">
        <form class="form-horizontal" action="form.php?form=Education" method="post">
          <div class="form-group">
            <label for="schoolCountry" class="col-lg-2 control-label">Secondary school country*</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="secondarySchoolCountry" placeholder="Country"/>
            </div>
          </div>

          <script type="text/javascript">
            function changeCountry() {
              if(document.getElementById("schoolCountry").value == "New Zealand") {
                document.getElementById("secondarySchool").disabled = false;
              } else {
                document.getElementById("secondarySchool").selectedIndex = 0;
                document.getElementById("secondarySchool").disabled = true;
              }
            }
          </script>

          <div class="form-group">
            <label for="secondarySchool" class="col-lg-2 control-label">Secondary school*</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="secondarySchool" placeholder="School" />
            </div>
          </div>
          <div class="form-group">
            <label for="lastYearAtSchool" class="col-lg-2 control-label">Last year at school*</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="lastYearAtSchool" placeholder="Year" id="lastSchoolYear" />
            </div>
          </div>
          <div class="form-group">
            <label for="mainLanguage" class="col-lg-2 control-label">Main language*</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="mainLanguage" placeholder="Language" />
            </div>
          </div>

          <div class="form-group">
            <label for="HighestSecondryQual" class="col-lg-2 control-label">Highest secondary qualification</label>
            <div class="col-lg-10">
              <select class="form-control" name="HighestSecondryQual">
                <option>No formal secondary school qualification</option>
                <option>14 or more credits at any level</option>
                <option>NCEA Level 1 or School Certificate</option>
                <option>NCEA Level 2 or 6th Form Certificate</option>
                <option>NCEA Level 3 or Bursary or Scholarship</option>
                <option>University Entrance</option>
                <option>Overseas qualification (includes International Baccalaureate &amp; Cambridge Exams)</option>
                <option>Other</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="HighestTertiaryQual" class="col-lg-2 control-label">Highest tertiary qualification</label>
            <div class="col-lg-10">
              <select class="form-control" name="HighestTertiaryQual" id="HighestTertiaryQual" onChange="HighestTertiaryQualChanged()">
                <option>No Qualification</option>
                <option>Bachelor Degree, Level 7 Graduate Diploma/Certificate, Level 7 Diploma/ Certificate</option>
                <option>Doctorate Degree</option>
                <option>Level 1 Certificate</option>
                <option>Level 2 Certificate</option>
                <option>Level 3 Certificate</option>
                <option>Level 4 Certificate</option>
                <option>Level 5 Diploma/Certificate</option>
                <option>Level 6 Graduate Certificate</option>
                <option>Masters Degree</option>
                <option>Postgraduate Diploma/Certificate, Bachelor Honours</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="qualificationLevel" class="col-lg-2 control-label">Qualification level</label>
            <div class="col-lg-10">
              <select class="form-control" name="qualificationLevel" id="qualificationLevel">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
              </select>
            </div>
          </div>

          <script type="text/javascript">
            function HighestTertiaryQualChanged() {
              document.getElementById("qualificationLevel").disabled = true;
              var value = document.getElementById("HighestTertiaryQual").value;
              if(value === "Certificate" || value === "Diploma") {
                document.getElementById("qualificationLevel").disabled = false;
              }
            }
          </script>

          <div class="form-group">
            <label for="firstYearAtTertiary" class="col-lg-2 control-label">First year at tertiary</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="firstYearAtTertiary" placeholder="YYYY" id="tertiaryYear" />
            </div>
          </div>
          <hr />

          <div class="form-group">
            <p class="help-block col-lg-offset-2 col-lg-10">Please select your occupation or activity before you started with your employer</p>
            <label for="previousEmployment" class="col-lg-2 control-label">Prior activity</label>
            <div class="col-lg-10">
              <select class="form-control" name="previousEmployment" id="previousEmployment">
                <option>Secondary school student</option>
                <option>Private Training Student</option>
                <option>Non-employed or Beneficiary</option>
                <option>Wage or Salary Worker</option>
                <option>Self-Employed</option>
                <option>University Student</option>
                <option>Polytechnic Student</option>
                <option>College of Education Student</option>
                <option>House-person or Retired</option>
                <option>Overseas</option>
                <option>Wananga Student</option>
              </select>
            </div>
          </div>
        </form>
        <div class="input-group col-lg-offset-2 col-lg-10">
          <button class="btn btn-default" id="nextButton" type="button" onclick="education()">Next Section</button>
        </div>
      </div>
    </div>
  </div>
</div>
