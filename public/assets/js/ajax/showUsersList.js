
/**
 * Requests from server a list of all users.
 * 
 * @param {string} sortBy String param to sort
 */
function showUsers(sortBy) {
  let xhr = new XMLHttpRequest();
  let url;
  if (sortBy == undefined || typeof sortBy != "string") {
    url = "/phoebe/controllers/showAllUsersController.php";      
  } else {
    switch (sortBy) {
        case "firstName": {
            url = "/phoebe/controllers/showAllUsersController.php?orderByLastName=true";   
            break; 
        }

    }
  }

  xhr.open(
    "GET",
    url,
    true
  );

  xhr.onload = function() {
    let output = "";
    if (this.status === 200) {
      let users = JSON.parse(this.responseText);
      output = formatUsersTable(output, users);
    }
    const showUsersPromise = new Promise((resolve, reject) => {
      if (output !== "") {
        document.getElementById("users").innerHTML = output; 
        resolve();
      } else {
        reject();
      }
    });

    showUsersPromise.then(
      () => {
        document.getElementById('firstName').addEventListener('click', showUsersListSortedByFirstName);
      },
      () => {
        document.getElementById("users").innerHTML = "Oops, reload the page, please:(";
      });
  };

  xhr.send();
}

window.onload = function() {
  showUsers();
  // this.document.getElementById('firstName').addEventListener('click', showUsersListSortedByFirstName);
};

function formatUsersTable(output, users) {
  if (users == undefined || users == null) {
    return "";
  }

  output +=
    '<div class="py-5">' +
    '<table class="table table-hover table-bordered">' +
    '<thead><tr>' +
    '<td>#</td>' +
    '<td><a href="#" id="firstName">First name</td>' +
    '<td>Last name</td>' +
    '<td>Email</td>' +
    '<td>Role</td>' +
    '</tr></thead>';

  for (const user in users) {
    let role = users[user].id == 1 ? "Admin" : "User";
    let id = users[user].id;
    output +=
      "<tbody><tr>" +
      '<td><a href="templates/profile.php?id=' +
      id +
      '">' +
      id +
      "</a></td>" +
      "<td>" +
      users[user].first_name +
      "</td>" +
      "<td>" +
      users[user].last_name +
      "</td>" +
      "<td>" +
      users[user].email +
      "</td>" +
      "<td>" +
      role +
      "</td>" +
      "</tr></tbody>";
  }
  output += "</table></div>";
  return output;
}

function showUsersListSortedByFirstName() {
    showUsers('firstName');    
}
