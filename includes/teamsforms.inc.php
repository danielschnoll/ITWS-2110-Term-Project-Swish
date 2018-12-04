</div>
      </nav>

<div class="row">
  <div class="col s12 m6">
    <div class="card green darken-2">
      <div class="card-content white-text">
        <span class="card-title">Create a Team</span>
        <p>Creating a team is simple. All you need is a unique name.</p>
      </div>
      <div class="card-action white-text">
        <form class = "container" action = "create_team_action.php" method="post">
          <input name = "name" placeholder="Team Name" id="name" type="text" class="validate">
          <button class="btn waves-effect waves-light" type="submit" name="action">Create Team
          <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
  </div>
  <div class="col s12 m6">
    <div class="card light-blue darken-2">
      <div class="card-content white-text">
        <span class="card-title">Join a Team</span>
        <p>Joining a team is also simple. Just type the name of the team.</p>
      </div>
      <div class="card-action white-text">
        <form class = "container" action = "join_team_action.php" method="post">
          <input name = "name" placeholder="Team Name" id="name" type="text" class="validate">
          <button class="btn waves-effect waves-light" type="submit" name="action">Join Team
          <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12 m6">
    <div class="card deep-orange darken-2">
      <div class="card-content white-text">
        <span class="card-title">Create an Event</span>
        <p>If both of your teams know you want to play, have someone from either side create the event.</p>
      </div>
      <div class="card-action white-text">
        <form class = "container" action = "create_event_action.php" method="post">
          <input name = "home_name" placeholder="Home Team Name" id="home_name" type="text" class="validate">
          <input name = "away_name" placeholder="Away Team Name" id="away_name" type="text" class="validate">
          <input name = "location" placeholder="Location" id="location" type="text" class="validate">
          <input name = "date" placeholder="Date" id="date" type="date" class="datepicker" >
          <input name = "time" placeholder="Time" id="time" type="time" class="timepicker">
          <button class="btn waves-effect waves-light" type="submit" name="action">Create Event
          <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
  </div>
  <div class="col s12 m6">
    <div class="card teal darken-2">
      <div class="card-content white-text">
        <span class="card-title">Add a Win/Loss</span>
        <p>Enter your win or loss</p>
      </div>
      <div class="card-action white-text">
        <form class = "container" action = "post_team_score_action.php" method="post">
          <input name = "home_name" placeholder="Home Team Name" id="home_name" type="text" class="validate">
          <input name = "away_name" placeholder="Away Team Name" id="away_name" type="text" class="validate">
          <input name = "home_score" placeholder = "Home Team Score" id = "home_score" type = "number" class = "validate" min = "0">
          <input name = "away_score" placeholder = "Away Team Score" id = "away_score" type = "number" class = "validate" min = "0">
          <input type = "number" disabled style="border-bottom: none;">
          <button class="btn waves-effect waves-light" type="submit" name="action">Add Game Details
            <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
