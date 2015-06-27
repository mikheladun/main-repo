package com.teksystems.eag;

import junit.framework.Assert;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

/**
 * This unit test case provides coverage for all methods in Basket class 

 * @author Mikhel Adun
 *
 */
public class BasketTest {

	Basket basket = null;

	@Before
	public void setUp() throws Exception {
		basket = new Basket();
	}

	@After
	public void tearDown() throws Exception {
	}

	@Test
	public void testGetItems() {
		basket.addItem(new Item(1, 12.49, true, false));
		Assert.assertNotNull(basket.getItems());
	}

	@Test
	public void testAddItem() {
		Assert.assertEquals(0, basket.getItems().size());
		basket.addItem(new Item(1, 11.25, true, false));
		Assert.assertEquals(1, basket.getItems().size());
	}

	@Test
	public void testToString() {
		Assert.assertEquals("", basket.toString());
		basket.addItem(new Item(1, 12.49, true, false));
		Assert.assertEquals("1 : 12.49\r\n", basket.toString());
	}

	@Test
	public void testIsEmpty() {
		Assert.assertTrue(basket.isEmpty());
		basket.addItem(new Item(1, 12.49, true, false));
		Assert.assertFalse(basket.isEmpty());
	}

}
