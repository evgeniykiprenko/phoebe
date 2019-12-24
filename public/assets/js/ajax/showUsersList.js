
/**
 * Requests from server a list of all users.
 * 
 * @param {string} sortBy String param to sort
 */
function showUsers(sortBy) {
  let xhr = new XMLHttpRequest();
  let url;
  if (sortBy == undefined || typeof sortBy != "string") {
    url = "/controllers/showAllUsersController.php";      
  } else {
    url = "/controllers/showAllUsersController.php/?sortBy" + sortBy + "=true";
  }

  xhr.open(
    "GET",
    url,
    true
  );

  xhr.onload = () => {
    let output = "";
    if (xhr.status === 200) {
      let users = JSON.parse(xhr.responseText);
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
        document.getElementById('id_column').addEventListener('click', showUsersListSortedById);
        document.getElementById('first_name_column').addEventListener('click', showUsersListSortedByFirstName);
        document.getElementById('last_name_column').addEventListener('click', showUsersListSortedByLastName);
        document.getElementById('email_column').addEventListener('click', showUsersListSortedByEmail);
        document.getElementById('role_column').addEventListener('click', showUsersListSortedByRole);
      },
      () => {
        document.getElementById("users").innerHTML = "Oops, reload the page, please:(";
      });
  };

  xhr.send();
}

window.onload = () => showUsers();

function formatUsersTable(output, users) {
  if (users === undefined || users == null) {
    return "";
  }

  output +=
    '<div class="py-5">' +
    '<table class="table table-hover table-bordered">' +
    '<thead><tr>' +
    '<td><a href="#" id="id_column">ID</a></td>' +
    '<td><a href="#" id="first_name_column">First name</a></td>' +
    '<td><a href="#" id="last_name_column">Last name</a></td>' +
    '<td><a href="#" id="email_column">Email</a></td>' +
    '<td><a href="#" id="role_column">Role</a></td>' +
    '</tr></thead>';

  for (const user in users) {
    let role = users[user].id === 1 ? "Admin" : "User";
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

function showUsersListSortedById() {
  showUsers('Id');    
}

function showUsersListSortedByFirstName() {
    showUsers('FirstName');    
}

function showUsersListSortedByLastName() {
  showUsers('LastName');    
}

function showUsersListSortedByEmail() {
  showUsers('Email');    
}

function showUsersListSortedByRole() {
  showUsers('Role');    
}

