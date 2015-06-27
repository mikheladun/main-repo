package com.teksystems.eag;

/**
 * Class for each item in shopping basket
 * 
 * @author Mikhel Adun
 */
class Item {
	private int quantity = 0;
	private String name = "";
	private double price = 0.00;
	private boolean exempt = false;
	private boolean imported = false;

	/**
	 * Constructor
	 */
	public Item() {
	}

	/**
	 * Constructor
	 * 
	 * @param quantity
	 * @param name
	 * @param price
	 * @param exempt
	 * @param imported
	 */
	Item(int quantity, String name, double price, boolean exempt, boolean imported) {
		this.quantity = quantity;
		this.name = name;
		this.price = price;
		this.exempt = exempt;
		this.imported = imported;
	}

	/**
	 * Constructor
	 * 
	 * @param quantity
	 * @param price
	 * @param exempt
	 * @param imported
	 */
	Item(int quantity, double price, boolean exempt, boolean imported) {
		this.quantity = quantity;
		this.price = price;
		this.exempt = exempt;
		this.imported = imported;
	}

	/**
	 * Getter for quantity value
	 * 
	 * @return
	 */
	public int getQuantity() {
		return (this.quantity);
	}

	/**
	 * Setter for quantity value
	 * 
	 * @param quantity
	 */
	public void setQuantity(int quantity) {
		this.quantity = quantity;
	}

	/**
	 * Getter for item name
	 * 
	 * @return
	 */
	public String getName() {
		return (this.name);
	}

	/**
	 * Setter for item name
	 * 
	 * @param name
	 */
	public void setName(String name) {
		this.name = name;
	}

	/**
	 * Getter for price of item
	 * 
	 * @return
	 */
	public double getPrice() {
		return (this.price);
	}

	/**
	 * Setter for price of item
	 * 
	 * @param price
	 */
	public void setPrice(double price) {
		this.price = price;
	}

	/**
	 * Getter for exempt value
	 * 
	 * @return
	 */
	public boolean isExempt() {
		return (this.exempt);
	}

	/**
	 * Setter for exempt value
	 * 
	 * @param exempt
	 */
	public void setExempt(boolean exempt) {
		this.exempt = exempt;
	}

	/**
	 * Getter for imported value
	 * 
	 * @return
	 */
	public boolean isImported() {
		return (this.imported);
	}

	/**
	 * Setter for imported value
	 * 
	 * @param imported
	 */
	public void setImported(boolean imported) {
		this.imported = imported;
	}

	/**
	 * Returns item in display format
	 */
	@Override
	public String toString() {
		StringBuffer output = new StringBuffer();
		output.append(this.getQuantity());
		output.append(" ");
		output.append(this.getName());
		output.append(": ");
		double tax = Application.calculateTax(this);
		output.append(Application.DECIMAL_FORMAT.format(this.getPrice() + tax));

		return (output.toString());
	}
}
