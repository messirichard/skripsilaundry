package id.placeholderlabs.laundry.models;

import com.google.gson.annotations.SerializedName;

public class User{

	@SerializedName("data")
	private Data data;

	@SerializedName("status")
	private int status;

	public void setData(Data data){
		this.data = data;
	}

	public Data getData(){
		return data;
	}

	public void setStatus(int status){
		this.status = status;
	}

	public int getStatus(){
		return status;
	}

	@Override
 	public String toString(){
		return 
			"User{" + 
			"data = '" + data + '\'' + 
			",status = '" + status + '\'' + 
			"}";
		}

	class Data{

		@SerializedName("salt")
		private Object salt;

		@SerializedName("address")
		private String address;

		@SerializedName("activation_code")
		private Object activationCode;

		@SerializedName("last_login")
		private String lastLogin;

		@SerializedName("created_at")
		private String createdAt;

		@SerializedName("active")
		private String active;

		@SerializedName("last_name")
		private String lastName;

		@SerializedName("ip_address")
		private String ipAddress;

		@SerializedName("access_token")
		private String accessToken;

		@SerializedName("password")
		private String password;

		@SerializedName("balance")
		private String balance;

		@SerializedName("forgotten_password_time")
		private Object forgottenPasswordTime;

		@SerializedName("phone")
		private String phone;

		@SerializedName("device_token")
		private String deviceToken;

		@SerializedName("remember_code")
		private Object rememberCode;

		@SerializedName("company")
		private Object company;

		@SerializedName("id")
		private String id;

		@SerializedName("first_name")
		private String firstName;

		@SerializedName("email")
		private String email;

		@SerializedName("forgotten_password_code")
		private Object forgottenPasswordCode;

		@SerializedName("username")
		private String username;

		public void setSalt(Object salt){
			this.salt = salt;
		}

		public Object getSalt(){
			return salt;
		}

		public void setAddress(String address){
			this.address = address;
		}

		public String getAddress(){
			return address;
		}

		public void setActivationCode(Object activationCode){
			this.activationCode = activationCode;
		}

		public Object getActivationCode(){
			return activationCode;
		}

		public void setLastLogin(String lastLogin){
			this.lastLogin = lastLogin;
		}

		public String getLastLogin(){
			return lastLogin;
		}

		public void setCreatedAt(String createdAt){
			this.createdAt = createdAt;
		}

		public String getCreatedAt(){
			return createdAt;
		}

		public void setActive(String active){
			this.active = active;
		}

		public String getActive(){
			return active;
		}

		public void setLastName(String lastName){
			this.lastName = lastName;
		}

		public String getLastName(){
			return lastName;
		}

		public void setIpAddress(String ipAddress){
			this.ipAddress = ipAddress;
		}

		public String getIpAddress(){
			return ipAddress;
		}

		public void setAccessToken(String accessToken){
			this.accessToken = accessToken;
		}

		public String getAccessToken(){
			return accessToken;
		}

		public void setPassword(String password){
			this.password = password;
		}

		public String getPassword(){
			return password;
		}

		public void setBalance(String balance){
			this.balance = balance;
		}

		public String getBalance(){
			return balance;
		}

		public void setForgottenPasswordTime(Object forgottenPasswordTime){
			this.forgottenPasswordTime = forgottenPasswordTime;
		}

		public Object getForgottenPasswordTime(){
			return forgottenPasswordTime;
		}

		public void setPhone(String phone){
			this.phone = phone;
		}

		public String getPhone(){
			return phone;
		}

		public void setDeviceToken(String deviceToken){
			this.deviceToken = deviceToken;
		}

		public String getDeviceToken(){
			return deviceToken;
		}

		public void setRememberCode(Object rememberCode){
			this.rememberCode = rememberCode;
		}

		public Object getRememberCode(){
			return rememberCode;
		}

		public void setCompany(Object company){
			this.company = company;
		}

		public Object getCompany(){
			return company;
		}

		public void setId(String id){
			this.id = id;
		}

		public String getId(){
			return id;
		}

		public void setFirstName(String firstName){
			this.firstName = firstName;
		}

		public String getFirstName(){
			return firstName;
		}

		public void setEmail(String email){
			this.email = email;
		}

		public String getEmail(){
			return email;
		}

		public void setForgottenPasswordCode(Object forgottenPasswordCode){
			this.forgottenPasswordCode = forgottenPasswordCode;
		}

		public Object getForgottenPasswordCode(){
			return forgottenPasswordCode;
		}

		public void setUsername(String username){
			this.username = username;
		}

		public String getUsername(){
			return username;
		}

		@Override
		public String toString(){
			return
					"Data{" +
							"salt = '" + salt + '\'' +
							",address = '" + address + '\'' +
							",activation_code = '" + activationCode + '\'' +
							",last_login = '" + lastLogin + '\'' +
							",created_at = '" + createdAt + '\'' +
							",active = '" + active + '\'' +
							",last_name = '" + lastName + '\'' +
							",ip_address = '" + ipAddress + '\'' +
							",access_token = '" + accessToken + '\'' +
							",password = '" + password + '\'' +
							",balance = '" + balance + '\'' +
							",forgotten_password_time = '" + forgottenPasswordTime + '\'' +
							",phone = '" + phone + '\'' +
							",device_token = '" + deviceToken + '\'' +
							",remember_code = '" + rememberCode + '\'' +
							",company = '" + company + '\'' +
							",id = '" + id + '\'' +
							",first_name = '" + firstName + '\'' +
							",email = '" + email + '\'' +
							",forgotten_password_code = '" + forgottenPasswordCode + '\'' +
							",username = '" + username + '\'' +
							"}";
		}
	}
}