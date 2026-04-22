import { __ } from '@wordpress/i18n';
import { select, dispatch } from '@wordpress/data';
import type { MediaFrame } from '@wordpress/media-utils';
import apiFetch from '@wordpress/api-fetch';

/**
 * Get Root.
 *
 * This function is responsible for returning
 * the Root Element.
 *
 * @since 1.0.0
 *
 * @param {string} id HTML Element Id.
 * @return Promise<HTMLElement>
 */
export const getRoot = ( id: string ): Promise< HTMLElement > => {
	let elapsedTime = 0;
	const interval = 25;

	return new Promise( ( resolve, reject ) => {
		const intervalId = setInterval( () => {
			elapsedTime += interval;
			const root = document.getElementById( id );

			if ( root ) {
				clearInterval( intervalId );
				resolve( root as HTMLElement );
			}

			if ( elapsedTime > 10 * interval ) {
				clearInterval( intervalId );
				reject( new Error( 'Unable to get root container...' ) );
			}
		}, interval );
	} );
};

/**
 * Get Modal Params.
 *
 * This function is responsible for getting the
 * Modal params values for the WP Media Window Frame
 * displayed to the user.
 *
 * @since 1.0.0
 *
 * @return {Object} Modal Params.
 */
export const getModalParams = () => {
	return {
		title: __( 'Select SQL File', 'sql-to-cpt' ),
		button: {
			text: __( 'Use SQL', 'sql-to-cpt' ),
		},
		multiple: false,
	};
};

/**
 * Handle Upload.
 *
 * This function is responsible for opening the
 * WP media modal to enable user select.
 *
 * @since 1.0.0
 *
 * @return {void}
 */
export const handleUpload = (): void => {
	const wpMediaModal: MediaFrame = wp.media( getModalParams() );

	wpMediaModal
		.on( 'select', async () => {
			const args = wpMediaModal
				.state()
				.get( 'selection' )
				.first()
				.toJSON();

			const { setSqlNotice, setParsedSQL, setIsLoading } = dispatch(
				'sql-to-cpt'
			) as any;

			// Reset.
			setSqlNotice( '' );
			setIsLoading( true );
			setParsedSQL( {
				tableName: '',
				tableColumns: [],
				tableRows: [],
			} );

			// Parse SQL.
			try {
				setParsedSQL(
					await apiFetch( {
						path: '/sql-to-cpt/v1/parse',
						method: 'POST',
						data: {
							...args,
						},
					} )
				);
			} catch ( { message } ) {
				setSqlNotice( message );
			}

			// Clear Notice.
			setIsLoading( false );
		} )
		.open();
};

/**
 * Handle Import.
 *
 * This function is responsible for handling the
 * import made by the user.
 *
 * @since 1.1.0
 *
 * @return Promise<void>
 */
export const handleImport = async (): Promise< void > => {
	const { getParsedSQL } = select( 'sql-to-cpt' ) as any;
	const { setSqlNotice, setIsLoading } = dispatch( 'sql-to-cpt' ) as any;

	// Set Notice.
	setIsLoading( true );

	// Import SQL.
	try {
		const url = await apiFetch( {
			path: '/sql-to-cpt/v1/import',
			method: 'POST',
			data: {
				...getParsedSQL(),
			},
		} );
		if ( url ) {
			window.location.href = `${ url }`;
		}
	} catch ( { message } ) {
		setSqlNotice( message );
	}

	// Clear Notice.
	setIsLoading( false );
};

/**
 * Handle Purge.
 *
 * This function is responsible for handling the
 * purge operation made by the user.
 *
 * @since 1.4.0
 *
 * @param {string} postType
 *
 * @return Promise<void>
 */
export const handlePurge = async ( postType: string ): Promise< void > => {
	const { setSqlNotice, setIsLoading } = dispatch( 'sql-to-cpt' ) as any;
	setIsLoading( true );

	try {
		await apiFetch( {
			path: '/sql-to-cpt/v1/purge',
			method: 'POST',
			data: {
				postType,
			},
		} );
		setIsLoading( false );
		window.location.reload();
	} catch ( { message } ) {
		setIsLoading( false );
		setSqlNotice( message );
	}
};
