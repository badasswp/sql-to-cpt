import { test, expect } from '@wordpress/e2e-test-utils-playwright';

export async function createNewPost( page ) {
	await page.goto( '/wp-admin/post-new.php' );
	await page.waitForSelector( '.edit-post-layout' );
}

test.describe( 'Search & Replace', () => {
	test.beforeEach( async ( { page } ) => {
		createNewPost( page );
	} );

	test( 'it displays the plugin icon', async ( { page } ) => {
		const closeIcon = page.getByRole( 'button', { name: 'Close' } );

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		const pluginIcon = page.getByRole( 'button', {
			name: 'Search & Replace',
		} );

		await expect( pluginIcon ).toBeVisible();
	} );

	test( 'it displays modal on icon click', async ( { page } ) => {
		const closeIcon = page.getByRole( 'button', { name: 'Close' } );

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		// Click Plugin icon.
		await expect(
			page.getByRole( 'button', {
				name: 'Search & Replace',
			} )
		).toBeVisible();
		await page
			.getByRole( 'button', {
				name: 'Search & Replace',
			} )
			.click();

		// Expect to see modal heading, label & form controls.
		await expect(
			page.getByRole( 'heading', { name: 'Search & Replace' } )
		).toBeVisible();

		// The Search label & textfield.
		await expect(
			page
				.locator( '#search-replace-modal__text-group' )
				.getByText( 'Search' )
		).toBeVisible();
		await expect(
			page.getByRole( 'textbox', { name: 'Search' } )
		).toBeVisible();

		// The Replace label & textfield.
		await expect(
			page
				.locator( '#search-replace-modal__text-group' )
				.getByText( 'Replace' )
		).toBeVisible();
		await expect(
			page.getByRole( 'textbox', { name: 'Replace' } )
		).toBeVisible();

		// The checkboxes.
		await expect(
			page.getByRole( 'checkbox', { name: 'Match case' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'checkbox', { name: 'Use regular expression' } )
		).toBeVisible();

		// The buttons.
		await expect(
			page.getByRole( 'button', { name: 'Replace' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'button', { name: 'Done' } )
		).toBeVisible();
	} );

	test( 'it matches text within the body content', async ( { page } ) => {
		const closeIcon = page.getByRole( 'button', { name: 'Close' } );

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		// Populate post title & content.
		const postTitle = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'textbox', { name: 'Add title' } );
		const postContent = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'document', { name: 'Empty block; start writing or' } );
		const blockEditor = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'button', { name: 'Add default block' } );

		await expect( postTitle ).toBeVisible();
		await postTitle.fill( 'Lorem ipsum dolor sit amet...' );

		await expect( blockEditor ).toBeVisible();
		await blockEditor.click();

		await expect( postContent ).toBeVisible();
		await postContent.fill(
			'Lorem ipsum dolor sit amet, consectetur adipiscing ipsum elit. Duis vestibulum at nulla vitae rutrum. Nunc purus nulla, tincidunt sed ipsum turpis in, ullamcorper commodo libero.'
		);

		// Click Plugin icon.
		await expect(
			page.getByRole( 'button', {
				name: 'Search & Replace',
			} )
		).toBeVisible();
		await page
			.getByRole( 'button', {
				name: 'Search & Replace',
			} )
			.click();

		// Type in word in Search field.
		await expect(
			page.getByRole( 'textbox', { name: 'Search' } )
		).toBeVisible();
		await page.getByRole( 'textbox', { name: 'Search' } ).fill( 'ipsum' );

		// Match word specific number of times.
		await expect( page.getByText( 'item(s) found.' ) ).toBeVisible();
		await expect( page.getByText( 'item(s) found.' ) ).toHaveText(
			'3 item(s) found.'
		);
	} );

	test( 'it performs search and replace for text', async ( { page } ) => {
		const closeIcon = page.getByRole( 'button', { name: 'Close' } );

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		// Populate post title & content.
		const postTitle = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'textbox', { name: 'Add title' } );
		const postContent = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'document', { name: 'Empty block; start writing or' } );
		const blockEditor = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'button', { name: 'Add default block' } );

		await expect( postTitle ).toBeVisible();
		await postTitle.fill( 'Lorem ipsum dolor sit amet...' );

		await expect( blockEditor ).toBeVisible();
		await blockEditor.click();

		await expect( postContent ).toBeVisible();
		await postContent.fill(
			'Lorem ipsum dolor sit amet, consectetur adipiscing ipsum elit. Duis vestibulum at nulla vitae rutrum. Nunc purus nulla, tincidunt sed ipsum turpis in, ullamcorper commodo libero.'
		);

		// Click Plugin icon.
		await expect(
			page.getByRole( 'button', {
				name: 'Search & Replace',
			} )
		).toBeVisible();
		await page
			.getByRole( 'button', {
				name: 'Search & Replace',
			} )
			.click();

		// Type in word in Search field.
		await expect(
			page.getByRole( 'textbox', { name: 'Search' } )
		).toBeVisible();
		await page.getByRole( 'textbox', { name: 'Search' } ).fill( 'ipsum' );

		// Type in word in Replace field.
		await expect(
			page.getByRole( 'textbox', { name: 'Replace' } )
		).toBeVisible();
		await page.getByRole( 'textbox', { name: 'Replace' } ).fill( 'hello' );

		// Replace text.
		await expect(
			page.getByRole( 'button', { name: 'Replace' } )
		).toBeVisible();
		await page.getByRole( 'button', { name: 'Replace' } ).click();

		// Match word specific number of times.
		await expect(
			page.getByText( 'item(s) replaced successfully.' )
		).toBeVisible();
		await expect(
			page.getByText( 'item(s) replaced successfully.' )
		).toHaveText( '3 item(s) replaced successfully.' );
	} );

	test( 'it matches text case for search and replace', async ( { page } ) => {
		const closeIcon = page.getByRole( 'button', { name: 'Close' } );

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		// Populate post title & content.
		const postTitle = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'textbox', { name: 'Add title' } );
		const postContent = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'document', { name: 'Empty block; start writing or' } );
		const blockEditor = page
			.locator( 'iframe[name="editor-canvas"]' )
			.contentFrame()
			.getByRole( 'button', { name: 'Add default block' } );

		await expect( postTitle ).toBeVisible();
		await postTitle.fill( 'Lorem ipsum dolor sit amet...' );

		await expect( blockEditor ).toBeVisible();
		await blockEditor.click();

		await expect( postContent ).toBeVisible();
		await postContent.fill(
			'Lorem Ipsum dolor sit amet, consectetur adipiscing ipsum elit. Duis vestibulum at nulla vitae rutrum. Nunc purus nulla, tincidunt sed ipsum turpis in, ullamcorper commodo libero.'
		);

		// Click Plugin icon.
		await expect(
			page.getByRole( 'button', {
				name: 'Search & Replace',
			} )
		).toBeVisible();
		await page
			.getByRole( 'button', {
				name: 'Search & Replace',
			} )
			.click();

		// Type in word in Search field.
		await expect(
			page.getByRole( 'textbox', { name: 'Search' } )
		).toBeVisible();
		await page.getByRole( 'textbox', { name: 'Search' } ).fill( 'Ipsum' );

		// Type in word in Replace field.
		await expect(
			page.getByRole( 'textbox', { name: 'Replace' } )
		).toBeVisible();
		await page.getByRole( 'textbox', { name: 'Replace' } ).fill( 'hello' );

		// Check the match case toggle.
		const matchCase = page.getByRole( 'checkbox', { name: 'Match case' } );
		await expect( matchCase ).toBeVisible();
		if ( ! ( await matchCase.isChecked() ) ) {
			await matchCase.click();
		}

		// Replace text.
		await expect(
			page.getByRole( 'button', { name: 'Replace' } )
		).toBeVisible();
		await page.getByRole( 'button', { name: 'Replace' } ).click();

		// Match word specific number of times.
		await expect(
			page.getByText( 'item(s) replaced successfully.' )
		).toBeVisible();
		await expect(
			page.getByText( 'item(s) replaced successfully.' )
		).toHaveText( '1 item(s) replaced successfully.' );
	} );

	test( 'it toggles case matching and use regular expression by default', async ( {
		page,
	} ) => {
		const closeIcon = page.getByRole( 'button', { name: 'Close' } );

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		await page.getByRole( 'link', { name: 'View Posts' } ).click();
		await expect(
			page.getByRole( 'link', { name: 'Posts', exact: true } )
		).toBeVisible();

		// Go to plugin options page.
		await page
			.getByRole( 'link', { name: 'Search & Replace for Block Editor' } )
			.click();
		await expect(
			page.getByRole( 'heading', {
				name: 'Search & Replace for Block Editor',
			} )
		).toBeVisible();

		// Enable Case Matching.
		const matchCase = page.locator( 'input[name="case_matching"]' );
		await expect( matchCase ).toBeVisible();
		if ( ! ( await matchCase.isChecked() ) ) {
			await matchCase.click();
		}

		// Enable Regex Matching.
		const matchRegex = page.locator( 'input[name="regex_matching"]' );
		await expect( matchRegex ).toBeVisible();
		if ( ! ( await matchRegex.isChecked() ) ) {
			await matchRegex.click();
		}

		// Save plugin options.
		await page.getByRole( 'button', { name: 'Save Changes' } ).click();

		// Now create a new post.
		await page.getByRole( 'link', { name: 'Posts', exact: true } ).click();
		await page
			.getByLabel( 'Main menu', { exact: true } )
			.getByRole( 'link', { name: 'Add Post' } )
			.click();

		await expect( closeIcon ).toBeVisible();
		await closeIcon.click();

		// Click Plugin icon.
		await expect(
			page.getByRole( 'button', {
				name: 'Search & Replace',
			} )
		).toBeVisible();
		await page
			.getByRole( 'button', {
				name: 'Search & Replace',
			} )
			.click();

		// Ensure toggles are visible.
		await expect(
			page.getByRole( 'checkbox', { name: 'Match case' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'checkbox', { name: 'Use regular expression' } )
		).toBeVisible();

		// Ensure toggles are checked by default.
		await expect(
			page.getByRole( 'checkbox', { name: 'Match case' } )
		).toBeChecked();
		await expect(
			page.getByRole( 'checkbox', { name: 'Use regular expression' } )
		).toBeChecked();
	} );
} );
