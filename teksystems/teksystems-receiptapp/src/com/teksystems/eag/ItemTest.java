package com.teksystems.eag;

import junit.framework.Assert;

import org.junit.Before;
import org.junit.Test;

/**
 * This unit test case provides coverage for all methods in Item class 

 * @author Mikhel Adun
 *
 */
public class ItemTest {

	Item item = null;

	@Before
	public void setUp() throws Exception {
		item = new Item();
	}

	@Test
	public void testItemConstructorIntStringDoubleBooleanBoolean() {
		item = new Item(1, "music CD", 14.99, false, false);
		Assert.assertNotNull(item);
		Assert.assertEquals(1, item.getQuantity());
		Assert.assertEquals("music CD", item.getName());
		Assert.assertEquals(14.99, item.getPrice());
		Assert.assertEquals(false, item.isExempt());
		Assert.assertEquals(false, item.isImported());
	}

	@Test
	public void testItemConstructorIntDoubleBooleanBoolean() {
		item = new Item(1, 14.99, true, true);
		Assert.assertEquals(1, item.getQuantity());
		Assert.assertEquals("", item.getName());
		Assert.assertEquals(14.99, item.getPrice());
		Assert.assertEquals(true, item.isExempt());
		Assert.assertEquals(true, item.isImported());
	}

	@Test
	public void testGetQuantity() {
		Assert.assertEquals(0, item.getQuantity());
	}

	@Test
	public void testSetQuantity() {
		item.setQuantity(1);
		Assert.assertEquals(1, item.getQuantity());
	}

	@Test
	public void testGetName() {
		Assert.assertEquals("", item.getName());
	}

	@Test
	public void testSetName() {
		item.setName("music CD");
		Assert.assertEquals("music CD", item.getName());
	}

	@Test
	public void testGetPrice() {
		Assert.assertEquals(0.00, item.getPrice());
	}

	@Test
	public void testSetPrice() {
		item.setPrice(6.99);
		Assert.assertEquals(6.99, item.getPrice());
	}

	@Test
	public void testIsExempt() {
		Assert.assertEquals(false, item.isExempt());
		item = new Item(1, 14.99, true, true);
		Assert.assertEquals(true, item.isExempt());
	}

	@Test
	public void testSetExempt() {
		item.setExempt(true);
		Assert.assertEquals(true, item.isExempt());
	}

	@Test
	public void testIsImported() {
		Assert.assertEquals(false, item.isImported());
		item = new Item(1, 14.99, true, true);
		Assert.assertEquals(true, item.isExempt());
	}

	@Test
	public void testSetImported() {
		item.setImported(true);
		Assert.assertEquals(true, item.isImported());
	}

	@Test
	public void testToString() {
		Assert.assertEquals("0 : 0.00", item.toString());
		item = new Item(1, "Name", 11.25, true, true);
		Assert.assertEquals("1 Name: 11.85", item.toString());
	}

}
