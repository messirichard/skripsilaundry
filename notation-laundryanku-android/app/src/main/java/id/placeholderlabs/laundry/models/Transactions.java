package id.placeholderlabs.laundry.models;

import java.util.List;
import com.google.gson.annotations.SerializedName;

public class Transactions{

	@SerializedName("data")
	private List<TransactionItem> data;

	@SerializedName("status")
	private int status;

	public void setData(List<TransactionItem> data){
		this.data = data;
	}

	public List<TransactionItem> getData(){
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
			"Transactions{" + 
			"data = '" + data + '\'' + 
			",status = '" + status + '\'' + 
			"}";
		}
}