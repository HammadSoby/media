 <div id="bookin">
  <form method="post" action="process.php?type=3"   enctype="multipart/form-data">
        <span id="book_title">You're About to book Ad Space In Print Adverstising : </span></br>
        <span id="book_down">Please choose one of these Print Agencies :  </span></br>
        <hr/></br>
        <label for="dates">Specify a Newspaper : </label></br>
        <select name="newspaper">
          <option>The Voice Newspaper</option>
          <option>The Vision</option>
          <option>GLA News</option>
          <option>Afro News</option>
          <option>Trumpet</option>
          <option>Phoenix</option>
          <option>Black Hair</option>
          <option>Diva Scribe</option>
          <option>Rewind</option>
          <option>Ovation</option>
          <option>Fab Magazine</option>
          <option>Ninetynine Magazine</option>
          <option>Arise Magazine</option>
          <option>Pride</option>
          <option>Afro Pulp</option>
          <option>Tropics</option>
          <option>Zen</option>
        </select></br></br>
          <style>
        #info_button{
          color:red;
          font-family: "open sans";
          cursor: pointer;
        }
        </style>
        <?php include 'off.core.includes/print_info.php'; ?>
        <label for="dates">Select Size of Slot: </label><span id="info_button">More info</span></br></br>
           <select name="slot">
          <option>A8 (52 x 74 mm) </option>
          <option>A7 (74 x 105 mm)</option>
          <option>A6 (105 x 148 mm)</option>
          <option>A5 (148 x 210 mm)</option>
          <option>A4 (210 x 297 mm)</option>
          <option>A3 (297 x 420 mm) </option>
         
          </select>
      
         
        </br></br>
         <label for="area">Placement Area : </label></br>
          <select name="area">
            <option>Travel</option>
            <option>Entertainment</option>
            <option>Sports</option>
            <option>Business</option>
            <option>Health</option>
            <option>World</option>
            <option>Other</option>
          </select></br></br>
          <?php include 'print_dates.php'; ?>
          
          
         
          <span id="note">
            Please note that it is important to provide us with your Ad slot)s) before deadline date.
          </span></br>
          <?php include 'off.core.includes/checkout_print.php'; ?>
           <style>
          #checkout_button{
            color:red;
            font-family: "open sans";
            font-weight: normal;
            cursor: pointer;

          }
          </style>
          <span id="checkout_button">Click Here to See The Prices Before you Checkout </span></br></br>
         
          <span id="rem">By Clicking Order You accept <a href="">Terms & Condition</a></span></br></br>
          <input type="submit" name="book" id="booka" value="Checkout & Book" /> 
        </form>
      </div>