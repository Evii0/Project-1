<div class="containerContainer" id="qualificationRecognition">
    <h1 class="page-header">Qualification Recognition</h1>
    <div class="contentContainer">
        <form class="form-horizontal" action="form.php?form=TraineeInformation" method="post" enctype="multipart/form-data">

          <h3>Recognition of other Qualification</h3>
          <div class="form-group">
            <input type="checkbox" id="qualificationCheckbox" class="col-lg-2 control-label">
            <div class="col-lg-10">
              <label for="qualificationCheckbox">Have a salesperson recognise a qualification (Price $345)</label>
            </div>

            <div class="revealActive">
              <div class="col-lg-10">
                <p>If you hold one of the qualifications listed below, you may be recognised as meeting the prescribed qualification that a person must hold
                  to be licensed, together with an assessment by The Skills Organisation and demonstration of sufficient knowledge.
                  A response letter will be sent to you advising of the next step in the process. You may be required to complete a one-hour contact
                  assessment depending on the type of application.</p>
                <p><i>Select the relevant Qualification:</i></p>

                <select class="form-control" name="schedule3">
                  <option>Bachelor of Commerce (Valuation and Property Management) conferred by Lincoln University after 1992</option>
                  <option>Bachelor of Property conferred by Auckland University after 1992</option>
                  <option>Bachelor of Business Studies (Real Estate) conferred by Massey University after 1992</option>
                  <option>Bachelor of Business Studies (Valuation and Property Management) conferred by Massey University between 1992 and 2005</option>
                  <option>Membership of the Royal Institution of Chartered Surveyors as a member or Fellow with chartered designation in general practice</option>
                  <option>Bachelor of Property Administration conferred by Auckland University after 1987</option>
                  <option>Bachelor of Business Studies (Valuation and Property Management) conferred by Massey University after 2005</option>
                </select>
              </div>
              <div class="col-lg-10">
                <br>
                <table>
                  <th><label>Upload a certified copy of your academic record or membership</label></th>
                  <th><p title="A certified copy must show the logo of the institution, date of completion, each paper taken, and be marked with a stamp of certification. If your qualification is not in your given name, please support it with copies of name change documentation. A verified copy is also acceptable if signed by a JP, lawyer or NZ Police." class="helper"><u><b>?</b></u></p></th>
                </table>
                <input type="file" name="qualRecogUploader" id="qualRecogUploader">
              </div>
            </div>
          </div>

        <h3>Trans-Tasman Mutual Recognition Application</h3>
        <div class="form-group">
          <input type="checkbox" id="tasmanCheckbox" class="col-lg-2 control-label">
          <div class="col-lg-10">
            <label for="tasmanCheckbox">Recognise qualification from New South Wales, Australia (Price $345)</label>
          </div>

        <div class="revealActive">
          <div class="col-lg-10">
            <p>Only for those who gained their Real Estate qualifications in New South Wales. You will be required to complete an
              assessment (unit standard 23137). Full information will be provided in a response letter.</p>
            <label for="qualificationName" class="col-lg-2 control-label">Qualification</label>
            <div class="col-lg-5">
              <input type="text" class="form-control" name="qualificationName" placeholder="Qualification Name">
            </div>
          </div>

          <div class="col-lg-10">
            <label for="transferDate" class="col-lg-2 control-label">Date licence transferred to New Zealand</label>
            <div class="col-lg-5">
              <br>
              <input type="text" class="form-control" name="transferDate" placeholder="dd/mm/yyyy">
            </div>
          </div>
          <div class="col-lg-10">
            <br>
            <table>
              <th><label>Upload a certified copy of your TTMR licence from REAA</label></th>
              <th><p title="A certified copy must show the logo of the institution, date of completion, each paper taken, and be marked with a stamp of certification. If your qualification is not in your given name, please support it with copies of name change documentation. A verified copy is also acceptable if signed by a JP, lawyer or NZ Police." class="helper"><u><b>?</b></u></p></th>
            </table>
            <input type="file" name="tasQualRecogUploader" id="tasQualRecogUploader">
          </div>
        </div>
      </div>
      <div class="input-group col-lg-offset-2 col-lg-10">
        <button class="btn btn-default" id="nextButton" type="button" onclick="nextSection('')">Submit</button>
      </div>
    </form>
  </div>
</div>
