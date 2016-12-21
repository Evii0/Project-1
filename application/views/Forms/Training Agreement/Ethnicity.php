<div class="containerContainer" id="ethnicity">
  <h1 class="page-header">Ethnicity</h1>
  <div class="contentContainer">
    <div id="columnContainer">
      <div class="columns">
                <label><input type="checkbox" id="NZ European/Pakeha" value="NZ European/Pakeha"> NZ European/Pakeha</label><br>
                <label><input type="checkbox" id="African" value="African"> African</label><br>
                <label><input type="checkbox" id="Australian" value="Australian"> Australian</label><br>
                <label><input type="checkbox" id="British/Irish" value="British/Irish"> British/Irish</label><br>
                <label><input type="checkbox" id="Cambodian" value="Cambodian"> Cambodian</label><br>
                <label><input type="checkbox" id="Chinese" value="Chinese"> Chinese</label><br>
                <label><input type="checkbox" id="Cook Island Maori" value="Cook Island Maori"> Cook Island Maori</label><br>
                <label><input type="checkbox" id="NZ Maori" value="NZ Maori" id="NZMaori"> NZ Maori</label><br>
                <label><input type="checkbox" id="Dutch" value="Dutch"> Dutch</label><br>
            </div>
            <div class="columns">
                <label><input type="checkbox" id="Fijian" value="Fijian"> Fijian</label><br>
                <label><input type="checkbox" id="Filipino" value="Filipino"> Filipino</label><br>
                <label><input type="checkbox" id="German" value="German"> German</label><br>
                <label><input type="checkbox" id="Greek" value="Greek"> Greek</label><br>
                <label><input type="checkbox" id="Indian" value="Indian"> Indian</label><br>
                <label><input type="checkbox" id="Italian" value="Italian"> Italian</label><br>
                <label><input type="checkbox" id="Japanese" value="Japanese"> Japanese</label><br>
                <label><input type="checkbox" id="Korean" value="Korean"> Korean</label><br>
                <label><input type="checkbox" id="Latin American" value="Latin American"> Latin American</label><br>
            </div>
            <div class="columns">
                <label><input type="checkbox" id="Middle Eastern" value="Middle Eastern"> Middle Eastern</label><br>
                <label><input type="checkbox" id="Niuean" value="Niuean"> Niuean</label><br>
                <label><input type="checkbox" id="South Slav" value="South Slav"> South Slav</label><br>
                <label><input type="checkbox" id="Sri Lankan" value="Sri Lankan"> Sri Lankan</label><br>
                <label><input type="checkbox" id="Tokelauan" value="Tokelauan"> Tokelauan</label><br>
                <label><input type="checkbox" id="Tongan" value="Tongan"> Tongan</label><br>
                <label><input type="checkbox" id="Vietnamese" value="Vietnamese"> Vietnamese</label><br>
                <label><input type="checkbox" id="Polish" value="Polish"> Polish</label><br>
                <label><input type="checkbox" id="Samoa" value="Samoa"> Samoan</label><br>
            </div>
            <div class="columns">
                <label><input type="checkbox" id="Other Asian" value="Other Asian"> Other Asian</label><br>
                <label><input type="checkbox" id="Other European" value="Other European"> Other European</label><br>
                <label><input type="checkbox" id="Other Pacific Nation" value="Other Pacific Nation"> Other Pacific Nation</label><br>
                <label><input type="checkbox" id="Other Southeast Asian" value="Other Southeast Asian"> Other Southeast Asian</label><br>
                <label><input type="checkbox" id="Other" value="Other"> Other</label><br>
                <div class="col-lg-10" id="other">
                    <input type="text" class="form-control" placeholder="Other Ethnicity" id="otherTextBox"/>
                </div>
            </div>
    </div>

    <div id="Iwicontainer">
      <div id="iwiText"><p>If you selected NZ Maori, please state the name(s) of all your Iwi</p></div>
        <div class="col-lg-10" id="iwiDiv">
          <input type="text" class="form-control" id="iwi" placeholder="Iwi"/>
        </div>
        <br><br>
        <div class="columns">
          <input type="checkbox" name="iwi" value="dontKnow" id="dontKnow"> I don't know<br>
          <input type="checkbox" name="iwi" value="dontIdentify" id="dontIdentify"> I don't identify with an Iwi<br>
        </div>
      </div>
    <div class="input-group col-lg-offset-2 col-lg-10">
      <button class="btn btn-default" id="nextButton" type="button" onclick="ethnicity()">Next Section</button>
    </div>
  </div>
</div>
