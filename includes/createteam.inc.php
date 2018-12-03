</div>
      </nav>

<div class="row">
    <div class="col s12 m12">
      <div class="card green darken-1">
        <div class="card-content white-text">
          <span class="card-title">Create a Team</span>
          <p>Creating a team is simple. All you need is a unique name.</p>
        </div>
        <div class="card-action white-text">
          <form class = "container" action = "create_team_action.php" method="post">
            <input name = "name" placeholder="Team Name" id="name" type="text" class="validate">
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col s12 m12">
      <div class="card light-blue darken-1">
        <div class="card-content white-text">
          <span class="card-title">Join a Team</span>
          <p>Joining a team is also simple. Just type the name of the team.</p>
        </div>
        <div class="card-action white-text">
          <form class = "container" action = "join_team_action.php" method="post">
            <input name = "name" placeholder="Team Name" id="name" type="text" class="validate">
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
            </button>
          </form>
        </div>
      </div>
    </div>
