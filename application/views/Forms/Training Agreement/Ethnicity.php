<div class="containerContainer" id="ethnicity">
    <h1 class="page-header">Ethnicity</h1>
    <div class="contentContainer">
        <div id="columnContainer">
            <div class="columns">
                <label><input type="checkbox" name="NZ European/Pakeha" value="NZ European/Pakeha"> NZ European/Pakeha</label><br>
                <label><input type="checkbox" name="African" value="Bike"> African</label><br>
                <label><input type="checkbox" name="Australian" value="Bike"> Australian</label><br>
                <label><input type="checkbox" name="British/Irish" value="Bike"> British/Irish</label><br>
                <label><input type="checkbox" name="Cambodian" value="Bike"> Cambodian</label><br>
                <label><input type="checkbox" name="Chinese" value="Bike"> Chinese</label><br>
                <label><input type="checkbox" name="Cook Island Maori" value="Bike"> Cook Island Maori</label><br>
                <label><input type="checkbox" name="NZ Maori" value="Bike" id="NZMaori"> NZ Maori</label><br>
                <label><input type="checkbox" name="Dutch" value="Bike"> Dutch</label><br>          
            </div>
            <div class="columns">
                <label><input type="checkbox" name="Fijian" value="Bike"> Fijian</label><br>
                <label><input type="checkbox" name="Filipino" value="Bike"> Filipino</label><br>  
                <label><input type="checkbox" name="German" value="Bike"> German</label><br>
                <label><input type="checkbox" name="Greek" value="Bike"> Greek</label><br>
                <label><input type="checkbox" name="Indian" value="Bike"> Indian</label><br>
                <label><input type="checkbox" name="Italian" value="Bike"> Italian</label><br>
                <label><input type="checkbox" name="Japanese" value="Bike"> Japanese</label><br>
                <label><input type="checkbox" name="Korean" value="Bike"> Korean</label><br>
                <label><input type="checkbox" name="Latin American" value="Bike"> Latin American</label><br>
            </div>
            <div class="columns">
                <label><input type="checkbox" name="Middle Eastern" value="Bike"> Middle Eastern</label><br>
                <label><input type="checkbox" name="Niuean" value="Bike"> Niuean</label><br>
                <label><input type="checkbox" name="South Slav" value="Bike"> South Slav</label><br>
                <label><input type="checkbox" name="Sri Lankan" value="Bike"> Sri Lankan</label><br>
                <label><input type="checkbox" name="Tokelauan" value="Bike"> Tokelauan</label><br>
                <label><input type="checkbox" name="Tongan" value="Bike"> Tongan</label><br>
                <label><input type="checkbox" name="Vietnamese" value="Bike"> Vietnamese</label><br>
                <label><input type="checkbox" name="Polish" value="Bike"> Polish</label><br>
                <label><input type="checkbox" name="Samoa" value="Bike"> Samoan</label><br>
            </div>
            <div class="columns">
                <label><input type="checkbox" name="Other Asian" value="Bike"> Other Asian</label><br>
                <label><input type="checkbox" name="Other European" value="Bike"> Other European</label><br>
                <label><input type="checkbox" name="Other Pacific Nation" value="Bike"> Other Pacific Nation</label><br>
                <label><input type="checkbox" name="Other Southeast Asian" value="Bike"> Other Southeast Asian</label><br>
                <label><input type="checkbox" name="Other" value="Bike"> Other</label><br>
                <div class="col-lg-10" id="other">
                    <input type="text" class="form-control" name="traineeFirstName" placeholder="Other Ethnicity" id="otherTextBox"/>
                </div>
            </div>
            
        </div>
        
        
        <div id="Iwicontainer">
            <div id="iwiText"><p>If you selected NZ Maori, please state the name(s) of all your Iwi</p></div>
            <div class="col-lg-10" id="iwiDiv">
                <input type="text" class="form-control" name="traineeFirstName" placeholder="Iwi"/>
            </div>
            <br><br>
            <div class="columns">
                <input type="checkbox" name="vehicle" value="Bike" id="dontKnow"> I don't know<br>
                <input type="checkbox" name="vehicle" value="Bike" id="dontIdentify"> I don't identify with an Iwi<br>
            </div>
        </div>
        <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="ethnicity()">Next Section</button></div>
    </div>
</div>