<div class="containerContainer" id="qualificationSelection">
    <h1 class="page-header">Qualification Selection</h1>
      <div class="contentContainer">
        <form class="form-horizontal" action="form.php?form=Qualification" method="post" enctype="multipart/form-data">
          <div id="salesperson">
            <h3>Salesperson</h3>
            <br>
            <table style="width:100%">
              <tr>
                <th class="first">Qualification/Programme</th>
                <th class="second">Programme Number</th>
                <th class="third">Price (incl GST)</th>
                <th>Duration</th>
              </tr>
              <tr>
                <td><input type="radio" name="sales" id="sales0" value="sales0"> National Certificate in Real Estate (Salesperson) (Level 4)</td>
                <td>02797V4-IN-306</td>
                <td>$1,095.00</td>
                <td>6 months</td>
              </tr>
              <tr>
                <td><input type="radio" name="sales" id="sales1" value="sales1"> Recognition of Current Competency - REAL Knowledge (Salesperson) Standard</td>
                <td>02797V2-IN-306-REAL</td>
                <td>$454.25</td>
                <td>n/a</td>
              </tr>
            </table>
          </div>

          <br>
          <div id="proprtyManagement">
            <h3>Property Management</h3><br>
            <table style="width:100%">
              <tr>
                <th class="first">Qualification/Programme</th>
                <th class="second">Programme Number</th>
                <th class="third">Price (incl GST)</th>
                <th>Duration</th>
              </tr>
              <tr>
                <td><input type="radio" name="property" id="property0" value="property0"> New Zealand Certificate in Residential Property Management (Level 3) Letting Agent</td>
                <td>03382V1-IN-306</td>
                <td>$994.75</td>
                <td>8 months</td>
              </tr>
              <tr>
                <td><input type="radio" name="property" id="property1" value="property1"> New Zealand Certificate in Residential Property Management (Level 4) Property Manager</td>
                <td>03403V1-IN-306</td>
                <td>$994.75</td>
                <td>8 months</td>
              </tr>
              <tr>
                <td><input type="radio" name="property" id="property2" value="property2"> Recognition of Current Competency - New Zealand Certificate in Residential Property Management (Level 4) Property Manager</td>
                <td>03403V1-IN-306-APL</td>
                <td>$994.75</td>
                <td>n/a</td>
              </tr>
            </table>
          </div>

          <br>
          <div id="branchOrAgentManagement">
            <h3>Branch or Agent Management</h3><br>
            <table style="width:100%">
              <tr>
                <th class="first">Qualification/Programme</th>
                <th class="second">Programme Number</th>
                <th class="third">Price (incl GST)</th>
                <th>Duration</th>
              </tr>
              <tr>
                <td><input type="radio" name="branch" id="branch0" value="branch0"> National Certificate in Real Estate (Branch Manager) (Level 5)</td>
                <td>02798V2-IN-306</td>
                <td>$1,995.25</td>
                <td>18 months</td>
              </tr>
              <tr>
                <td><input type="radio" name="branch" id="branch1" value="branch1"> National Diploma in Real Estate (Agent) (Level 5)</td>
                <td>03069V2-IN-306</td>
                <td>$2,990.00</td>
                <td>30 months</td>
              </tr>
              <tr>
                <td><input type="radio" name="branch" id="branch2" value="branch2"> Recognition of Current Competency - Branch Manager</td>
                <td>02798V2-IN-306-APL</td>
                <td>$2,990.00</td>
                <td>n/a</td>
              </tr>
              <tr>
                <td><input type="radio" name="branch" id="branch3" value="branch3"> Recognition of Current Competency - Agent</td>
                <td>03069V2-IN-306-APL</td>
                <td>$3,910.00</td>
                <td>n/a</td>
              </tr>
            </table>
      </div>
      <br>
      <div class="input-group col-lg-offset-2 col-lg-10">
        <button class="btn btn-default" id="nextButton" type="button" onclick="nextSection('qualificationRecognition')">Next Section</button>
      </div>
    </form>
  </div>
</div>
