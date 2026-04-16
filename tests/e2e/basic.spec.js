import { test, expect } from '@wordpress/e2e-test-utils-playwright';
import path from 'path';

export async function openPluginPage( page ) {
	await page.goto( '/wp-admin/admin.php?page=sql-to-cpt' );
	await page.waitForSelector( '#sql-to-cpt' );
}

test.describe( 'SQL to CPT', () => {
	test.beforeEach( async ( { page } ) => {
		openPluginPage( page );
	} );

	test( 'it displays the plugin page', async ( { page } ) => {
		await expect(
			page.getByRole( 'heading', { name: 'SQL to CPT' } )
		).toBeVisible();
		await expect(
			page.getByText(
				'Import & Convert SQL files to Custom Post Types (CPT)'
			)
		).toBeVisible();
		await expect(
			page.getByRole( 'button', { name: 'Upload SQL File' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'button', { name: 'Purge CPT' } )
		).toBeVisible();
	} );

	test( 'it should open WP media modal', async ( { page } ) => {
		const uploadButton = page.getByRole( 'button', {
			name: 'Upload SQL File',
		} );
		await expect( uploadButton ).toBeVisible();

		await uploadButton.click();

		await expect(
			page.getByRole( 'heading', { name: 'Select SQL File' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'tab', { name: 'Upload files' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'tab', { name: 'Media Library' } )
		).toBeVisible();
		await expect(
			page.getByRole( 'button', { name: 'Use SQL' } )
		).toBeVisible();
	} );

	test( 'it should upload and import a SQL file', async ( { page } ) => {
		const uploadButton = page.getByRole( 'button', {
			name: 'Upload SQL File',
		} );

		await uploadButton.click();

		const fileInput = page.locator( 'input[type="file"]' );
		const filePath = path.resolve( __dirname, 'fixtures/students.sql' );

		await fileInput.setInputFiles( filePath );

		const useSqlButton = page.getByRole( 'button', { name: 'Use SQL' } );
		await useSqlButton.waitFor( { state: 'visible' } );

		await useSqlButton.click();

		// TODO: We need to assert that we see the parsed columns.
	} );
} );
