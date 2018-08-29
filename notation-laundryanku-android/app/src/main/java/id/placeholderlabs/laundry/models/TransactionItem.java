package id.placeholderlabs.laundry.models;

import com.google.gson.annotations.SerializedName;

public class TransactionItem {

	@SerializedName("transaction_id")
	private String transactionId;

	@SerializedName("taken_out_at")
	private Object takenOutAt;

	@SerializedName("retreived_at")
	private String retreivedAt;

	@SerializedName("created_at")
	private String createdAt;

	@SerializedName("status_laundry")
	private String statusLaundry;

	@SerializedName("weight_total")
	private String weightTotal;

	@SerializedName("laundry_qty")
	private String laundryQty;

	@SerializedName("payment_type")
	private String paymentType;

	@SerializedName("user_id")
	private String userId;

	@SerializedName("status_pembayaran")
	private String statusPembayaran;

	@SerializedName("price")
	private String price;

	@SerializedName("employee_id")
	private String employeeId;

	@SerializedName("name")
	private String name;

	@SerializedName("update_at")
	private Object updateAt;

	@SerializedName("laundry_packet_id")
	private String laundryPacketId;

	public void setTransactionId(String transactionId){
		this.transactionId = transactionId;
	}

	public String getTransactionId(){
		return transactionId;
	}

	public void setTakenOutAt(Object takenOutAt){
		this.takenOutAt = takenOutAt;
	}

	public Object getTakenOutAt(){
		return takenOutAt;
	}

	public void setRetreivedAt(String retreivedAt){
		this.retreivedAt = retreivedAt;
	}

	public String getRetreivedAt(){
		return retreivedAt;
	}

	public void setCreatedAt(String createdAt){
		this.createdAt = createdAt;
	}

	public String getCreatedAt(){
		return createdAt;
	}

	public void setStatusLaundry(String statusLaundry){
		this.statusLaundry = statusLaundry;
	}

	public String getStatusLaundry(){
		return statusLaundry;
	}

	public void setWeightTotal(String weightTotal){
		this.weightTotal = weightTotal;
	}

	public String getWeightTotal(){
		return weightTotal;
	}

	public void setLaundryQty(String laundryQty){
		this.laundryQty = laundryQty;
	}

	public String getLaundryQty(){
		return laundryQty;
	}

	public void setPaymentType(String paymentType){
		this.paymentType = paymentType;
	}

	public String getPaymentType(){
		return paymentType;
	}

	public void setUserId(String userId){
		this.userId = userId;
	}

	public String getUserId(){
		return userId;
	}

	public void setStatusPembayaran(String statusPembayaran){
		this.statusPembayaran = statusPembayaran;
	}

	public String getStatusPembayaran(){
		return statusPembayaran;
	}

	public void setPrice(String price){
		this.price = price;
	}

	public String getPrice(){
		return price;
	}

	public void setEmployeeId(String employeeId){
		this.employeeId = employeeId;
	}

	public String getEmployeeId(){
		return employeeId;
	}

	public void setName(String name){
		this.name = name;
	}

	public String getName(){
		return name;
	}

	public void setUpdateAt(Object updateAt){
		this.updateAt = updateAt;
	}

	public Object getUpdateAt(){
		return updateAt;
	}

	public void setLaundryPacketId(String laundryPacketId){
		this.laundryPacketId = laundryPacketId;
	}

	public String getLaundryPacketId(){
		return laundryPacketId;
	}

	@Override
 	public String toString(){
		return 
			"TransactionItem{" +
			"transaction_id = '" + transactionId + '\'' + 
			",taken_out_at = '" + takenOutAt + '\'' + 
			",retreived_at = '" + retreivedAt + '\'' + 
			",created_at = '" + createdAt + '\'' + 
			",status_laundry = '" + statusLaundry + '\'' + 
			",weight_total = '" + weightTotal + '\'' + 
			",laundry_qty = '" + laundryQty + '\'' + 
			",payment_type = '" + paymentType + '\'' + 
			",user_id = '" + userId + '\'' + 
			",status_pembayaran = '" + statusPembayaran + '\'' + 
			",price = '" + price + '\'' + 
			",employee_id = '" + employeeId + '\'' + 
			",name = '" + name + '\'' + 
			",update_at = '" + updateAt + '\'' + 
			",laundry_packet_id = '" + laundryPacketId + '\'' + 
			"}";
		}
}