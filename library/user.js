// JavaScript Document
function checkAddUserForm()
{
	with (window.document.frmAddUser) {
		
		if (isEmpty(txtEmail, 'Enter Email!')) {
			return;
		} else if (isEmpty(txtPassword, 'Enter password')) {
			return;
		} else if (isEmpty(txtFname, 'Enter First name')) {
			return;
		} else if (isEmpty(txtLname, 'Enter Last name')) {
			return;
		} else if (isEmpty(txtFullname, 'Enter Full name')) {
			return;
		} else if (isEmpty(cname, 'Enter Your Country Name')) {
			return;
		} else if (isEmpty(dob, 'Enter Date of Birth')) {
			return;
		} else if (isEmpty(sem, 'Enter Your Semester')) {
			return;
		} else if (isEmpty(univ, 'Enter Your University')) {
			return;
		} else if (isEmpty(maj, 'Enter Your Major')) {
			return;
		} else if (isEmpty(gpa, 'Enter Your GPA')) {
			return;					
		} else if (isNaN(gpa.value) || (gpa.value > 4.0) || gpa.value < 0.0) {			
			alert('GPA should be a numnber between 0.0 and 4.0');
		  return;
		} else if (isEmpty(choice1, 'Choose Your 1st Project')) {
			return;						
		} else if (isEmpty(choice2, 'Choose Your 2nd Project')) {
			return;	
		} else if (isEmpty(choice3, 'Choose Your 3rd Project')) {
			return;	
		} else if (isEmpty(choice4, 'Choose Your 4th Project')) {
			return;	
		}else {
			submit();
		}
	}
}

function addUser()
{
	window.location.href = 'view.php?v=adduser';
}

function editUser(id)
{
	window.location.href = 'user/index.php?view=edit&id=' + id;
	//alert(id);
}

function deleteUser(userId)
{
	if (confirm('Delete this user?')) {
		window.location.href = 'user/processUser.php?action=delete&userId=' + userId;
	}
}

