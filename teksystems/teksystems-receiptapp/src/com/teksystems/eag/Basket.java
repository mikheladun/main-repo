package com.teksystems.eag;

import java.util.ArrayList;
import java.util.List;

/**
 * Class for shopping basket which contains items
 * 
 * @author Mikhel Adun
 */
public class Basket {

	// list of items in basket
	private List<Item> items = null;

	/**
	 * Default Constructor
	 */
	public Basket() {
	}

	/**
	 * Getter for items
	 * 
	 * @return
	 */
	public List<Item> getItems() {
		return (this.items == null ? new ArrayList<Item>() : this.items);
	}

	/**
	 * Setter for items
	 * 
	 * @param item
	 */
	public void addItem(Item item) {
		// lazy initialize List of items
		if (this.items == null) {
			this.items = new ArrayList<Item>();
		}
		this.items.add(item);
	}

	/**
	 * Returns formatted string of items in Basket
	 * 
	 * @param basket
	 */
	@Override
	public String toString() {
		StringBuffer output = new StringBuffer();
		for (Item item : this.getItems()) {
			output.append(item);
			output.append("\r\n");
		}

		return (output.toString());
	}

	/**
	 * Returns true if basket contains items otherwise false
	 * 
	 * @return true/false
	 */
	public boolean isEmpty() {
		return (items == null || items.isEmpty());
	}
}
