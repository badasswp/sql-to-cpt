import { useSelect } from '@wordpress/data';

interface NoticeProps {
	message: string;
}

/**
 * Notice Component.
 *
 * This function returns a JSX component that is
 * a display notice.
 *
 * @since 1.0.0
 *
 * @return {JSX.Element} The Notice component.
 */
const Notice = (): JSX.Element => {
	const { sqlNotice } = useSelect( ( select ) => {
		const store: any = select( 'sql-to-cpt' );

		return {
			sqlNotice: store.getSqlNotice(),
		};
	}, [] );

	return sqlNotice && <nav>{ sqlNotice }</nav>;
};

export default Notice;
