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
 * @param {Object}      props         - The component props.
 * @param {NoticeProps} props.message - Message to be displayed in notice.
 *
 * @return {JSX.Element} The Notice component.
 */
const Notice = ( { message }: NoticeProps ): JSX.Element => {
	return message && <nav>{ message }</nav>;
};

export default Notice;
