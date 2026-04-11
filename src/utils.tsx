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
	const wpMediaModal = wp.media( getModalParams() );
	wpMediaModal.on( 'select', () => handleSelect( wpMediaModal ) ).open();
};

/**
 * Handle Selection.
 *
 * This function is responsible for handling a
 * selection made by the user.
 *
 * @since 1.0.0
 *
 * @param {MediaFrame} wpMediaModal WP Media Modal.
 * @return Promise<void>
 */
export const handleSelect = async (
	wpMediaModal: MediaFrame
): Promise< void > => {
	const args = wpMediaModal.state().get( 'selection' ).first().toJSON();
	const { setSqlNotice, setParsedSQL, setIsLoading } = dispatch(
		'sql-to-cpt'
	) as any;

	// Reset.
	setSqlNotice( '' );
	setParsedSQL( {
		tableName: '',
		tableColumns: [],
		tableRows: [],
	} );
	setIsLoading( true );

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
		setIsLoading( false );
	} catch ( { message } ) {
		setIsLoading( false );
		setSqlNotice( message );
	}
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
		setIsLoading( false );
	} catch ( { message } ) {
		setIsLoading( false );
		setSqlNotice( message );
	}
};
